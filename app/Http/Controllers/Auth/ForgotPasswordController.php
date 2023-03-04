<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function userResetPasswordForm()
    {
        return view('frontend.auth.forgot');
    }

    public function broker()
    {
        return Password::broker('users');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
    }

    public function userResetPasswordMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user) {

            $remembertoken = Str::random(40);

            User::where('id', $user->id)->update([
                'remember_token' => $remembertoken,
            ]);

            $details = [
                'subject' => 'Welcome to ' . ' ' . config('app.name'),
                'greeting' => 'Hi, Your password reset link successfully sent.',
                'body' => 'Your requested password sent successfully done from ' . ' ' . config('app.name'). '. '. 'Now You can change your password from given the link.',
                'email' => 'Your email is : ' . $request->email,
                'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
                'actionText' => 'Change Password',
                'actionURL' => route('user.password.reset', $remembertoken),
                'site_url' => route('frontend.index'),
                'site_name' => config('app.name'),
                'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
            ];

            Mail::to($request->email)->send(new RegisterMail($details));

            return redirect()->back()->with('message', 'Requested password reset link successfully sent');

        }else {
            return redirect()->back()->with('error', 'Requested email has no record in server');
        }

    }

}
