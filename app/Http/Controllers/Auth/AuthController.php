<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

// BotDetectCaptcha class
use LaravelCaptcha\Integration\BotDetectCaptcha;

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
        ]);
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

  /**
   * Get captcha instance to handle for the register page
   *
   * @return object
   */
  private function getRegisterCaptchaInstance()
  {
    // Captcha parameters:
    $captchaConfig = [
      'CaptchaId' => 'RegisterCaptcha', // a unique Id for the Captcha instance
      'UserInputId' => 'CaptchaCode', // Id of the Captcha code input textbox
       // The path of the Captcha config file is inside the Controllers folder
      'CaptchaConfigFilePath' => 'captcha_config/RegisterCaptchaConfig.php'
    ];
    return BotDetectCaptcha::GetCaptchaInstance($captchaConfig);
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\Http\Response
   */
  public function getRegister()
  {
    // captcha instance of the register page
    $captcha = $this->getRegisterCaptchaInstance();

    // passing Captcha Html to register view
    return view('auth.register', ['captchaHtml' => $captcha->Html()]);
  }

  /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function postRegister(Request $request)
  {
    $validator = $this->validator($request->all());

    // captcha instance of the register page
    $captcha = $this->getRegisterCaptchaInstance();

    // validate the user-entered Captcha code when the form is submitted
    $code = $request->input('CaptchaCode');
    $isHuman = $captcha->Validate($code);

    if (!$isHuman || $validator->fails()) {
      if (!$isHuman) {
        $validator->errors()->add('CaptchaCode', 'Wrong code. Try again please.');
      }

      return redirect()
              ->back()
              ->withInput()
              ->withErrors($validator->errors());
    }

    Auth::login($this->create($request->all()));

    return redirect($this->redirectPath());
  }

  public function authenticated(Request $request, $user) {
      if($request->remember == 'yes') {
          $remembercookie = cookie()->forever('remember', $user->email);
          Cookie:queue($remembercookie);
      }
      return redirect()->intended($this->redirectPath());
  }
}
