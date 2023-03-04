<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }


    public function signIn()
    {
        return view('frontend.auth.login');
    }

    public function userSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $verified = User::where('email', $request->email)->first();
        if (isset($verified) && isset($verified->email_verified_at)) {
            $user_pass_less = User::where('email', $request->email)->whereNull('password')->first();
            if ($user_pass_less) {
                Auth::guard('user')->login($user_pass_less);
                return redirect()->route('user.profile')->with('success', 'You are sucessfully login');
            } else {
                $this->validate($request, [
                    'password' => 'required',
                ]);
                $user = User::where('email', $request->email)->first();
                if($user) {
                    if(Hash::check($request->password, $user->password)) {
                        Auth::guard('user')->login($user);
                        return redirect()->route('user.profile')->with('success', 'You are sucessfully login');
                    }else {
                        return redirect()->back()->with('info', 'Password do not match');
                    }
                }else {
                    return redirect()->back()->with('error', 'User not found');
                }
            }
        } elseif($verified) {
            $details = [
                'subject' => 'Welcome to ' . ' ' . config('app.name'),
                'greeting' => 'Hi you just register on' . ' ' . config('app.name'),
                'body' => 'Thanks for register ' . ' ' . config('app.name'),
                'email' => 'Your email is : ' . $request->email,
                'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
                'actionText' => 'Click Here to Verify',
                'actionURL' => route('user.verify', $verified->token),
                'site_url' => route('frontend.index'),
                'site_name' => config('app.name'),
                'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
            ];

            Mail::to($request->email)->send(new RegisterMail($details));
            return redirect()->back()->withInput()->with('error', 'Please verify your email');
        }else {
            return redirect()->back()->withInput()->with('error', 'User not found');
        }




    }
}
