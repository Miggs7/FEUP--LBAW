<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getEmail(Request $request)
    {
        $this->validateEmail($request);

        $status = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        switch ($status)
        {
            case Password::RESET_LINK_SENT:
                return view('auth.login')->with('msg',"A recovery email has been sent to the provided address" );

            default:
                return view('auth.login')->withErrors(['msg' => "We can't find a user with that email address" ]);
        }
    }
}