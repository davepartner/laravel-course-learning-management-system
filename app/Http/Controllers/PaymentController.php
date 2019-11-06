<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Hash;
use Mail;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Paystack;
use App\Models\Payment;
use App\Models\User;
use App\Models\CourseUser; 
use App\Models\Course;
use App\Mail\PaymentSubmitted;
use App\Mail\PaymentSubmittedAdmin;
use App\Mail\PaymentConfirmed;


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
                    'password' => Hash::make($paymentDetails['data']['customer']['email']) 

                    ]);

                $checkUser2 = User::where('email', $paymentDetails['data']['customer']['email'])->first();
                if($checkUser2){
                    $user_id = $checkUser2->id;
                }
            }
            

        }

        //update payments table
        Payment::create([
            'user_id' => $user_id,
            'course_id' => $paymentDetails['data']['metadata']['course_id'],
            'amount' => ($paymentDetails['data']['amount']/100),
            'status' => 'confirmed',
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
        if (!Auth::check()) {
            Auth::loginUsingId($user_id);
        }
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
        if(Auth::user()->role_id < 3){
            $payments = Payment::latest()->get();
        }else{
            $payments = Payment::where('user_id', Auth::user()->id)->latest()->get();
        }
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

        // Mail::to($request->user())
        //     ->cc($moreUsers)
        //     ->bcc($evenMoreUsers)
        //     ->send(new OrderShipped($order));

//check if user is currently logged in while reporting bank account
        if (Auth::check() AND Auth::user()->role_id > 2) {
            
                $user_id = Auth::user()->id;
            $input['user_id'] = Auth::user()->id;
            
         
        } else {
            //check if already has an account
            $checkUser = User::where('email', $input['email'])->first();
            //if true, get their id
            if ($checkUser) {
                $user_id = $checkUser->id;
                $input['user_id'] = $checkUser->id;
            } else {
                //otherwise, create new account for user
              $userCreate =  User::create([
                    'name' => $input['email'],
                    'first_name' => 'null',
                    'last_name' => 'null',
                    'email' => $input['email'],
                    'password' =>  Hash::make($input['email'])

                ]);

                if($userCreate){
                    $input['user_id'] = $userCreate->id;
                }
            }


        }

        $payment = Payment::where('user_id', $input['user_id'])
        ->where('course_id', $input['course_id'])->first();
        if(!$payment){
                $payment = $this->paymentRepository->create($input);
                //send email to user 
             }

        Mail::to($input['email'])
            ->send(new PaymentSubmitted( $payment));

        //send email to admin
        Mail::to('realdavepartner@gmail.com')
            ->send(new PaymentSubmittedAdmin($payment));
  

        Flash::success('Payment submitted successfully. You will get an email once we receive the payment confirmation. Admin will activate your course once your payment is verified within 24 hours');
        if(!Auth::check()){
            Auth::loginUsingId($user_id);
        }

        
        return redirect()->route('payments.index');
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

        $courses = Course::all();

        return view('payments.edit')
        ->with('courses', $courses)
        ->with('payment', $payment);
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
        $input = $request->all();
        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }



 //TODO: send notification email to user

        Flash::success('Payment updated successfully.');



        $payment = $this->paymentRepository->update($input, $id);
      
      //Payment::where('id', $id)->update($input); 
        //


if($input['status'] == 'confirmed'){
        CourseUser::create([
            'user_id' => $payment->user_id,
            'course_id' => $payment->course_id,
            'status' => 1,
            'paid_amount' => $payment->amount,
                //'paid_date' => $paymentDetails['data']['paid_at'] 
        ]);

            Mail::to($payment->user['email'])
                ->send(new PaymentConfirmed($payment));

    }elseif($input['status'] == 'refund requested'){
        //delete subscription if this guy asked for refund
           $getCourseUser =  CourseUser::where('user_id', Auth::user()->id)
            ->where('course_id', $payment->course_id )->first();
                $this->paymentRepository->delete($id);

            Flash::success('Refund requested successfully. 
            Access to course revoked. You\'ll get your refund within 7 days');    
    }


       

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

        if($payment->status == 'confirmed'){
        //delete courseUser too
        //Find the courseUser
        $courseUser = CourseUser::where('course_id', $payment->course_id)
        ->where('user_id', $payment->user_id)->delete();
        }

        Flash::success('Payment deleted successfully.');
        }

        return redirect(route('payments.index'));
    }
}
