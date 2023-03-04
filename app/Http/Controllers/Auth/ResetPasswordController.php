<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserLoginMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    public function userShowResetForm($token)
    {
        $user = User::where('remember_token', $token)->first();
        if($user) {
            return view('frontend.auth.resetpassword', compact('user'));
        }else {
            return redirect()->back()->with('error', 'Someting went worng. Plase try again.');
        }
    }

    public function passwordUpdate(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if ($user) {

            if ($request->password == $request->password_confirmation) {

                User::where('id', $user->id)->update([
                    'password' => Hash::make($request->password),
                ]);

                $details = [
                    'subject' => 'Welcome to '.' '.config('app.name'),
                    'greeting' => 'Hi, you just password change on '.' '.config('app.name'),
                    'body' => 'Thanks for change your password on'.' '.config('app.name'). 'Now your account is secure.',
                    'email' => 'Your email is : '.$user->email,
                    'password' => 'Your password is : '.$request->password,
                    'thanks' => 'Thank you and stay with'.' '.config('app.name'),
                    'actionText' => 'Visit Website',
                    'site_url' => route('frontend.index'),
                    'site_name' => config('app.name'),
                    'copyright' => '©'.' '.Carbon::now()->format('Y').' '.config('app.name').' '.'All rights reserved.',
                ];

                Mail::to($user->email)->send(new UserLoginMail($details));

                return redirect()->route('signin')->with('success', 'Password successfully done. Please login to your account');

            } else {
                return redirect()->back()->with('error', 'Password do not match. Please confirm you password');
            }

        } else {
            return redirect()->route('signin')->with('error', 'Someting went worng. Please try again.');
        }

    }

    public function broker()
    {
        return Password::broker('users');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }
}
