<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PreviousUrl;
use Validator;
use Auth;

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

    use PreviousUrl {
      PreviousUrl::__construct as PreviousUrlConstructor;
    }

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
    public function __construct(Request $request)
    {
      $this->PreviousUrlConstructor();

      $this->middleware('guest', ['except' => 'logout']);
    }

    /**
    * Return a login page.
    */
    public function show ()
    {
      return view('auth.login');
    }

    /**
     * Validate request
     * @param Request $request
    */
    public function validation (Request $request)
    {
      $this->validate($request, [
        'usernameOrEmail' => 'required',
        'password' => 'required'
      ]);
    }

    /**
     * Try to sign in.
     * @param Request $request
    */
    public function sign_in(Request $request)
    {
      $values['password'] = $request->password;

      if(filter_var($request->usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        $values['email'] = $request->usernameOrEmail;
      }else {
        $values['username'] = $request->usernameOrEmail;
      }

      if(Auth::attempt($values)) {
        if(!Auth::user()->is_activated) {

          Auth::logout();

          return redirect()->back()->with('warning', 'Sorry but your account is not activated.');
        }
        return $this->switchPreviousUrl();
      }

      return redirect()->back()->with('warning', 'Invalid data.');
    }


    /**
     * Initialize post login.
    */
    public function login (Request $request)
    {
      $this->validation($request);

      return $this->sign_in($request);
    }

    /**
     * Default logout.
    */
    public function logout ()
    {
      Auth::logout();

      session()->forget('previous');

      return redirect()->route('home');
    }
}
