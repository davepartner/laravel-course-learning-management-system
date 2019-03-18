<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Paystack;
use App\Models\Payment;
use App\Models\User;
use App\Models\CourseUser;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }


    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want

        //confirm that payment went through
        //Grant user access to course paid for

        //redirect if payment failed
        if ($paymentDetails['data']['status'] != 'success') {
            Flash::error('Sorry, payment failed. Please try another form of payment');

            //redirect
            return redirect()->route('courses.show',['id'=> $paymentDetails['data']['metadata']['course_id']]);
        }


        if(Auth::check()){
            $user_id = Auth::user()->id;
        }else{
            //check if already has an account
            $checkUser = User::where('email', $paymentDetails['data']['customer']['email'])->first();
            //if true, get their email
            if($checkUser){
                $user_id = $checkUser->id;
            }else{
                //otherwise, create new account for user
                User::create([
                    'name' => $paymentDetails['data']['customer']['first_name'] . ' ' . $paymentDetails['data']['customer']['last_name'],
                    'first_name' => $paymentDetails['data']['customer']['first_name'],
                    'last_name' => $paymentDetails['data']['customer']['last_name'],
                    'email' => $paymentDetails['data']['customer']['email'],
                    'password' => 'johndoe'

                    ]);

                $checkUser = User::where('email', $paymentDetails['data']['customer']['email'])->first();
                if($checkUser){
                    $user_id = $checkUser->id;
                }
            }
            

        }

        //update payments table
        Payment::create([
            'user_id' => $user_id,
            'course_id' => $paymentDetails['data']['metadata']['course_id'],
            'amount' => ($paymentDetails['data']['amount']/100),
            'status' => 'successful',
            'mode_of_payment' => $paymentDetails['data']['channel'],
            'payment_processor' => 'paystack',
        ]);

        //update course_user table 
      
            CourseUser::create([
                'user_id' => $user_id,
                'course_id' => $paymentDetails['data']['metadata']['course_id'],
                'status' => 1,
                'paid_amount' => ($paymentDetails['data']['amount'] / 100),
                //'paid_date' => $paymentDetails['data']['paid_at'] 
            ]);

            //TODO: send success email/sms

 //redirect 
        Flash::success('Payment successful, you are now subscribed to this course');

            //redirect
        return redirect()->route('courses.show', ['id' => $paymentDetails['data']['metadata']['course_id']]);
      
    }

    
    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->paymentRepository->pushCriteria(new RequestCriteria($request));
        $payments = $this->paymentRepository->all();

        return view('payments.index')
            ->with('payments', $payments);
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $payment = $this->paymentRepository->create($input);

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payment', $payment);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $payment = $this->paymentRepository->update($request->all(), $id);

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }
        if (Auth::check() and (Auth::user()->role_id < 2 )) {
        $this->paymentRepository->delete($id);

        Flash::success('Payment deleted successfully.');
        }

        return redirect(route('payments.index'));
    }
}
