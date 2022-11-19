<?php


namespace App\Http\Controllers\Auth;

use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*protected function guard(){
        return Auth::guard('web');
    }*/

    /*protected function guard(){
        return Auth::guard('manager');
    }*/

    /*Go home if sucessful login */
    protected function attemptLogin(Request $request) {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }
        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }  
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function getUser(){
        return $request->user();
    }*/

    public function home() {
        return redirect('login');
    }

}
