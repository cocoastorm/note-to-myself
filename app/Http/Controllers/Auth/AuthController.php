<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $maxLoginAttempts = 3;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Override credentials to check if user is active before logging in!
     *
     * @param Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');

        return array_add($credentials, 'active', 'active');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'g-captcha-response' => 'required'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $secret = '6LfM2xETAAAAABaid8-qOvJpiR-dQtNsiIi61fTj';
        $gRecaptchaResponse = $request->input('g-recaptcha-response');
        $remoteIp = $request->ip;
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
        if(!($resp->isSuccess())) {
            $errors = $resp->getErrorCodes();
            return redirect()
                ->back()
                ->withInput($request->only('name', 'email'))
                ->withErrors([$errors => 'Invalid Captcha!']);
        }

        Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $active = str_random(30);
      Mail::send('welcome', ['name'=>$data['name'], 'code'=>$active], function($message){
        $message->to('jondeluz@hotmail.com', 'Some guy')->subject('Welcome fam');
      });
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'active' => $active,
            'password' => bcrypt($data['password']),
        ]);
    }
}
