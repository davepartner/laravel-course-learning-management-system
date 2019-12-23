<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Flash;
class GoogleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('google')->user();


        //check if user exists and log user in

        $user = User::where('email', $userSocial->email)->first();
        if($user){
            if(Auth::loginUsingId($user->id)){
               return redirect()->route('home');
            }
        }

        //sometimes their is no url in the payload maybe because user doesntr have googleplus account yet
        $url = null; 
        if(isset($userSocial->user['url'])){
            $url = $userSocial->user['url'];
        }
        $gender = null;
        if(isset($userSocial->user['gender'])){
            $gender = $userSocial->user['gender'];
        }
     //else sign the user up
     $userSignup = User::create([
            'name' => $userSocial->name,
            'email' => $userSocial->email,
            'password' => bcrypt('123314'),
            //'avatar'=> $userSocial->avatar,
           // 'google_profile'=> $url,
            'gender'=> $gender
        ]);

      
        //finally log the user in
        if($userSignup){
            if(Auth::loginUsingId($userSignup->id)){
                Flash::success('Login Successful');
                return redirect()->route('home');
            }
        }

    }


}
