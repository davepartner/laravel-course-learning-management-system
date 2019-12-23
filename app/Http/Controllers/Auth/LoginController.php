<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;
class LoginController extends Controller
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
    protected $redirectTo = '/payments';

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
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        $userSocial  = Socialite::driver('facebook')->user();

        //check if user exists and log user in
        $user = User::where('email', $userSocial->user['email'])->first();
        if ($user) {
            if (Auth::loginUsingId($user->id)) {
                //decide where to redirect 
                if (Auth::user()->role_id < 3) {
                    return redirect()->route('settings.index');
                }
                return redirect()->route('categories.index');
            }
        }

        if (empty($userSocial->user['link']) || !isset($userSocial->user['link'])) {
            $userSocial->user['link'] = 'https://fb.com';
        }

        if (empty($userSocial->user['gender']) || !isset($userSocial->user['gender'])) {
            $userSocial->user['gender'] = 'not specified';
        }

        //else sign the user up
        $userSignup = User::create([
            'name' => $userSocial->user['name'],
            'email' => $userSocial->user['email'],
            'password' => bcrypt('1234'),
            'avatar' => $userSocial->avatar,
            'facebook_profile' => $userSocial->user['link'],
            'gender' => $userSocial->user['gender']
        ]);

        //finally log the user in
        if ($userSignup) {
            if (Auth::loginUsingId($userSignup->id)) {


                return redirect()->route('categories.index');
            }
        }


    }
}
