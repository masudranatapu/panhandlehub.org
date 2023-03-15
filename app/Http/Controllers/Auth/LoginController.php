<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'password' => 'required',
        ]);
        $verified = User::where('email', $request->email)->first();
        if (isset($verified) && isset($verified->email_verified_at)) {
            if (Hash::check($request->password, $verified->password)) {
                Auth::guard('user')->login($verified);
                return redirect()->route('user.setting')->with('success', 'You are sucessfully login');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password does not match');
            }
        } elseif ($verified) {
            $details = [
                'subject' => 'Welcome to ' . ' ' . config('app.name'),
                'greeting' => 'Hi you have created account on' . ' ' . config('app.name'),
                'body' => 'Thanks for registration with ' . ' ' . config('app.name'),
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
        } else {
            return redirect()->back()->withInput()->with('error', 'User not found');
        }
    }
}
