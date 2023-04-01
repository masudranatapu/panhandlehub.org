<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessangerController;
use App\Http\Controllers\Frontend\AdPostController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LocalizationController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\SellerDashboardController;
Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('ads/{category?}/{subcategory?}', [FrontendController::class, 'search'])->name('search');
    Route::get('details/{slug}', [FrontendController::class, 'details'])->name('details');
    Route::get('wishlist', [FrontendController::class, 'wishlistCreate'])->name('wishlist.create');
    Route::get('about', [FrontendController::class, 'about'])->name('about');
    Route::get('terms-conditons', [FrontendController::class, 'termsCondition'])->name('terms.condition');
    Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::get('faq', [FrontendController::class, 'faq'])->name('faq');
    Route::get('ban', [FrontendController::class, 'ban'])->name('ban');
    Route::get('price-plan', [FrontendController::class, 'pricePlan'])->name('price.plan');
    Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('seller/shop/{username}', [FrontendController::class, 'sellerShop'])->name('seller.shop');
    Route::post('contact/submit', [FrontendController::class, 'contactSub'])->name('contact.submit');
    Route::get('payment/post/{id}', [FrontendController::class, 'postPayment'])->name('payment.post');
    Route::get('payment/invoice/{id}',[FrontendController::class,'paymentInvoice'])->name('payment.invoice');


    //Localization
    Route::post('lange', [LocalizationController::class, 'setLang'])->name('localization');
    Route::get('/country', [LocalizationController::class, 'country'])->name('country');


    Route::post('country', [FrontendController::class, 'setCountry'])->name('setCountry');




    // Route::get('create-post/post-type', [AdPostController::class, 'postType'])->name('create-post.step_one');
    // Route::get('create-post/post-type/category', [AdPostController::class, 'postStepTwo'])->name('create-post.step_two');
    // Route::get('create-post/post-type/sub-category', [AdPostController::class, 'postSubCategory'])->name('create-post.step_three');


    Route::get('create-post/{type?}/{subcategory?}', [AdPostController::class, 'create'])->name('post.create');
    Route::post('store-post', [AdPostController::class, 'store'])->name('post.store');
});

// seller
Route::group(['as' => 'seller.', 'prefix' => 'seller'], function () {
    Route::get('profile/{username}', [SellerDashboardController::class, 'sellerProfile'])->name('profile');
    Route::post('seller/review', [SellerDashboardController::class, 'storeReview'])->name('review.store');
});

Route::group(['as' => 'user.'], function () {
    Route::middleware(['auth:user', 'verified'])->group(function () {
        Route::get('user/post', [UserDashboardController::class, 'profile'])->name('profile');
        Route::get('user/post/delete/{id}', [UserDashboardController::class, 'deletePost'])->name('post.delete');
        Route::get('user/post/edit/{slug}', [UserDashboardController::class, 'editPost'])->name('post.edit');
        Route::post('user/post/update/{slug}', [UserDashboardController::class, 'updatePost'])->name('post.update');
        Route::get('user/post/statusUpdate/{id}/{status}', [UserDashboardController::class, 'statusUpdate'])->name('post.statusUpdate');
        Route::get('user/drafts', [UserDashboardController::class, 'drafts'])->name('drafts');
        Route::get('user/favourite', [UserDashboardController::class, 'favourite'])->name('favourite');
        Route::get('user/favouriteDelete/{id}', [UserDashboardController::class, 'favouriteDelete'])->name('favourite.delete');
        Route::get('user/transaction',[UserDashboardController::class, 'transaction'])->name('transaction');
        Route::get('user/transaction/details/{id}',[UserDashboardController::class, 'transactionDetails'])->name('transaction.details');
        Route::get('user/dashboard', [UserDashboardController::class, 'setting'])->name('setting');
        Route::get('user/passwordReset', [UserDashboardController::class, 'passwordReset'])->name('password.reset');
        Route::post('user-logout', [UserDashboardController::class, 'userLogOut'])->name('logout');
        Route::get('user/profile',[UserDashboardController::class,'userProfile'])->name('userProfile');
        Route::post('user/profile/picture/update', [UserDashboardController::class, 'profileUpdate'])->name('userProfile.update');



        // Route::get('user/message', [UserDashboardController::class, 'userMessage'])->name('message');
        Route::get('user/review', [UserDashboardController::class, 'userReview'])->name('review');

        Route::controller(MessangerController::class)->group(function () {
           Route::get('user/message/{username?}', 'index')->name('message');
            Route::post('message/{username}', 'sendMessage')->name('message.store');
            Route::post('message/marks/read/{username}', 'messageMarkasRead')->name('message.markas.read');
        });

    });
});

