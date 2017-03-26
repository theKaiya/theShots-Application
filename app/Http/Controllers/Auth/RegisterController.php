<?php

namespace App\Http\Controllers\Auth;

use App\TheShots\Models\Page;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\TheShots\Helpers\Models\UserInstanceHelper;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\TheShots\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance.
     * @return User
    */
    public function create (Request $request)
    {
      return User::create([
        'username' => $request->get('username'),
        'email' => $request->get('email'),
        'password' => bcrypt($request->get('password')),
        'picture' => UserInstanceHelper::userDefaultImage(),
        'social' => UserInstanceHelper::userDefaultNetworks(),
      ]);
    }

    /**
     * Validate request
     * @param Request $request
    */
    public function validation (Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|min:3|max:255|unique:users,email',
            'password' => 'required|max:255|min:3'
        ]);
    }

    /**
     * Show a register page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show ()
    {
        $terms = Page::find('terms');

        return view('auth.register', [
            'terms' => $terms,
        ]);
    }

    /**
     * Register the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register (Request $request)
    {
        $this->validation($request);

        $user = $this->create($request);
        
        if($user) {

            auth()->loginUsingId($user->id);

            return redirect()->route('home');
        }
        return redirect()->back()->with('warning', 'Undefined error during registration.');
    }
}
