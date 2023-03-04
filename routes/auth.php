<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use Illuminate\Http\Request;

Auth::routes(['login' => false, 'register' => false]);

// login
Route::get('sign-in', [LoginController::class, 'signIn'])->name('signin');
Route::post('user-sign-in', [LoginController::class, 'userSignIn'])->name('user.signin');
// register
Route::post('user-sign-up', [RegisterController::class, 'userSignUp'])->name('user.signup');
Route::get('user-verify/{token}', [RegisterController::class, 'userVerify'])->name('user.verify');
Route::post('user-sign-up-success', [RegisterController::class, 'userSignUpSuccess'])->name('user.signup.success');
Route::post('user-sign-up-success-with-out-password', [RegisterController::class, 'userSignUpSuccesswithOurPassword'])->name('user.signup.success.withoutpassword');

Route::post('/customer/login', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('frontend.login')->middleware('auth_logout');

// Reset Password
Route::get('user/forgot/password', [ForgotPasswordController::class, 'userResetPasswordForm'])->name('user.forgot.password');
Route::post('user/forgot/password/mail', [ForgotPasswordController::class, 'userResetPasswordMail'])->name('user.password.mail');
// password update
Route::get('user/password-reset/{token}', [ResetPasswordController::class, 'userShowResetForm'])->name('user.password.reset');
Route::post('user/password-change', [ResetPasswordController::class, 'passwordUpdate'])->name('user.password.update');

// Social Authentication
Route::controller(SocialLoginController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');
    Route::get('/auth/{provider}/callback', 'callback')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');
});

//Auth Guard Logout
Route::post('auth-logout', function (Request $request) {
    if ($request->auth === 'customer') {
        Auth::guard('user')->logout();
        return redirect()->route('users.login');
    }
})->name('auth.logout');

Route::get('login', [App\Http\Controllers\Frontend\LoginController::class, 'showLoginForm'])->name('users.login');

// Admin Authentication
Route::controller(AdminLoginController::class)->prefix('admin')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.admin');
    Route::post('/login', 'login')->name('admin.login');
    Route::post('/logout', 'logout')->name('admin.logout');
});

Route::middleware(['guest:admin'])->group(function () {
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('password/email', 'sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset', 'showLinkRequestForm')->name('admin.password.request');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::post('password/reset', 'reset')->name('admin.password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('admin.password.reset');
    });
});
