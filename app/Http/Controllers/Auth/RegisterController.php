<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\UserLoginMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function userSignUp(Request $request)
    {
        $user = User::where('email', $request->email)->get();

        if ($user->count() > 0) {
            return redirect()->back()->with('info', 'Your email has already an account. Plase login to your account');
        } else {
            $random_token = Str::random(40);
            $email = explode('@', $request->email);
            $username = $email[0]. '_' . random_int(1111,9999);
            User::insert([
                'email' => $request->email,
                'username' => $username,
                'token' => $random_token,
                'created_at' => Carbon::now(),
            ]);

            $details = [
                'subject' => 'Welcome to ' . ' ' . config('app.name'),
                'greeting' => 'Hi you just register on' . ' ' . config('app.name'),
                'body' => 'Thanks for register ' . ' ' . config('app.name'),
                'email' => 'Your email is : ' . $request->email,
                'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
                'actionText' => 'Click Here to Verify',
                'actionURL' => route('user.verify', $random_token),
                'site_url' => route('frontend.index'),
                'site_name' => config('app.name'),
                'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
            ];

            Mail::to($request->email)->send(new RegisterMail($details));
            return redirect()->back()->with('message', 'A verification link has been sent to your mail. Please Check Your mail.');
        }
    }

    public function userVerify($token)
    {
        $user = User::where('token', $token)->first();
        if ($user) {
            if (isset($user->email_verified_at)) {
                return redirect()->route('signin')->with('success', 'You are already verified. Please login.');
            }
            return view('frontend.auth.verify', compact('user'));
        } else {
            return redirect()->route('signin')->with('error', 'Someting went worng with your verify token. Please try again.');
        }
    }

    public function userSignUpSuccesswithOurPassword(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        if ($user) {
            $user->update([
                'email_verified_at' => now(),
            ]);

            Auth::guard('user')->login($user);

            $details = [
                'subject' => 'Welcome to ' . ' ' . config('app.name'),
                'greeting' => 'Hi you just login on' . ' ' . config('app.name'),
                'body' => 'Thanks for Login on ' . ' ' . config('app.name') . ' without set password. Please change your password as soon as possible. For security reasons you can change your password from your proifle setting',
                'email' => 'Your email is : ' . $user->email,
                'password' => 'Your password is : N/L ',
                'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
                'actionText' => 'Visit Website',
                'site_url' => route('frontend.index'),
                'site_name' => config('app.name'),
                'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
            ];

            Mail::to($user->email)->send(new UserLoginMail($details));

            return redirect()->route('user.profile')->with('success', 'You are sucessfully login without you password');
        } else {
            return redirect()->route('signin')->with('error', 'Someting went worng with your account. Please try again.');
        }
    }


    public function userSignUpSuccess(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if ($user) {
            if ($request->password == $request->password_confirmation) {

                $user->update([
                    'password' => Hash::make($request->password),
                    'email_verified_at' => now()
                ]);

                Auth::guard('user')->login($user);

                $details = [
                    'subject' => 'Welcome to ' . ' ' . config('app.name'),
                    'greeting' => 'Hi you just login on' . ' ' . config('app.name'),
                    'body' => 'Thanks for Login on ' . ' ' . config('app.name') . ' with set password. Now your account is secure.',
                    'email' => 'Your email is : ' . $user->email,
                    'password' => 'Your password is : ' . $request->password,
                    'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
                    'actionText' => 'Visit Website',
                    'site_url' => route('frontend.index'),
                    'site_name' => config('app.name'),
                    'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
                ];

                Mail::to($user->email)->send(new UserLoginMail($details));

                return redirect()->route('user.profile')->with('success', 'You are sucessfully login with password');

            } else {
                return redirect()->back()->with('error', 'Password do not match. Please confirm you password');
            }
        } else {
            return redirect()->route('signin')->with('error', 'Someting went worng. Please try again.');
        }
    }
}
