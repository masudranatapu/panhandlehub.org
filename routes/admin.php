<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\AdTypesController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SocialiteController;
use App\Http\Controllers\Admin\CmsSettingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ManualPaymentController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Setting\GeneralSettingController;

Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        // reset password
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::post('password/email', 'sendResetLinkEmail')->name('admin.password.email');
            Route::get('password/reset', 'showLinkRequestForm')->name('admin.password.request');
        });
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::post('password/reset', 'reset')->name('admin.password.update');
            Route::get('password/reset/{token}', 'showResetForm')->name('admin.password.reset');
        });
    });

    Route::middleware(['auth:admin'])->group(function () {
        //Dashboard Route
        Route::controller(AdminController::class)->group(function () {
            Route::get('/',  'dashboard');
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
            Route::post('/admin/search', 'search')->name('admin.search');
        });

        //Profile Route
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile/settings', 'setting')->name('profile.setting');
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/profile', 'profile_update')->name('profile.update');
        });

        //Roles Route
        Route::resource('role', RolesController::class);

        //Users Route
        Route::resource('user', UserController::class);

        // Report
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');

        // Order Route
        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('order.index');
            Route::get('/orders/{transaction}', 'show')->name('order.show');
            Route::post('/admin/download/transaction/invoice/{transaction}', 'downloadTransactionInvoice')->name('admin.transaction.invoice.download');
        });

        // ========================================================
        // ====================Setting=============================
        // ========================================================
        Route::controller(GeneralSettingController::class)->prefix('settings/general')->name('settings.')->group(function () {
            // brand Update
            Route::get('/brand', 'general')->name('general');
            Route::put('/brand', 'generalUpdate')->name('general.update');

            Route::get('/app', 'appConfig')->name('general.app.config');
            Route::put('/app', 'appConfigUpdate')->name('general.app.config.update');

            // website watermark update
            Route::get('/watermark', 'watermark')->name('general.watermark');
            Route::put('/watermark', 'watermarkUpdate')->name('general.watermark.update');

            // broadcasting update
            Route::get('/broadcast', 'broadcasting')->name('general.broadcasting');
            Route::put('/broadcast', 'broadcastingUpdate')->name('general.broadcasting.update');

            // recaptcha Update
            Route::get('/recaptcha', 'recaptcha')->name('general.recaptcha');
            Route::put('recaptcha/update', 'recaptchaUpdate')->name('general.recaptcha.update');
        });

        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('layout', 'layout')->name('layout');
            Route::put('layout', 'layoutUpdate')->name('layout.update');
            Route::put('mode', 'modeUpdate')->name('mode.update');
            Route::get('theme', 'theme')->name('theme');
            Route::put('theme', 'colorUpdate')->name('theme.update');
            Route::get('custom', 'custom')->name('custom');
            Route::put('custom', 'customCssJSUpdate')->name('custom.update');
            Route::get('email', 'email')->name('email');
            Route::put('email', 'emailUpdate')->name('email.update');
            Route::post('test-email', 'testEmailSent')->name('email.test');

            // sytem update
            Route::get('system', 'system')->name('system');
            Route::put('system/update', 'systemUpdate')->name('system.update');
            Route::put('allowLangChanging', 'allowLaguageChanage')->name('allow.langChange');
            Route::put('change/timezone', 'timezone')->name('change.timezone');

            // cookies routes
            Route::get('cookies', 'cookies')->name('cookies');
            Route::put('cookies/update', 'cookiesUpdate')->name('cookies.update');

            // seo
            Route::get('seo/index', 'seoIndex')->name('seo.index');
            Route::get('seo/edit/{page}', 'seoEdit')->name('seo.edit');
            Route::post('seo/content/create', 'seoContentCreate')->name('seo.content.create');
            Route::put('seo/content/{content}', 'seoContentUpdate')->name('seo.content.update');
            Route::delete('seo/content/delete/{content}', 'seoContentDelete')->name('seo.content.delete');

            // module routes
            Route::get('modules', 'module')->name('module');
            Route::put('module/update', 'moduleUpdate')->name('module.update');

            // website configuration
            Route::put('website/configuration/update', 'websiteConfigurationUpdate')->name('website.configuration.update');

            // pusher configuration
            Route::put('pusher/configuration/update', 'pusherConfigurationUpdate')->name('pusher.configuration.update');

            // website watermark update
            Route::put('website/watermark/update', 'websiteWatermarkUpdate')->name('website.watermark.update');

            // sitemap
            Route::get('generate/sitemap', 'generateSitemap')->name('generateSitemap');

            // upgrade application
            Route::get('upgrade', 'upgrade')->name('upgrade');
            Route::post('upgrade/apply', 'upgradeApply')->name('upgrade.apply');
        });

        Route::controller(SocialiteController::class)->group(function () {
            Route::get('settings/social-login', 'index')->name('settings.social.login');
            Route::put('settings/social-login', 'update')->name('settings.social.login.update');
            Route::post('settings/social-login/status', 'updateStatus')->name('settings.social.login.status.update');
        });

        Route::controller(PaymentController::class)->prefix('settings/payment')->name('settings.')->group(function () {
            Route::get('/', 'index')->name('payment');
            Route::put('/', 'update')->name('payment.update');
            Route::post('/status', 'updateStatus')->name('payment.status.update');

            // Manual Payment
            Route::get('/manual', 'manualPayment')->name('payment.manual');
            Route::post('/manual/store', 'manualPaymentStore')->name('payment.manual.store');
            Route::get('/manual/{manual_payment}/edit', 'manualPaymentEdit')->name('payment.manual.edit');
            Route::put('/manual/{manual_payment}/update', 'manualPaymentUpdate')->name('payment.manual.update');
            Route::delete('/manual/{manual_payment}/delete', 'manualPaymentDelete')->name('payment.manual.delete');
            Route::get('/manual/status/change', 'manualPaymentStatus')->name('payment.manual.status');
        });

        // ==================== Skin System =====================
        Route::controller(ThemeController::class)->group(function () {
            Route::get('/skins', 'index')->name('module.themes.index');
            Route::put('/skins', 'update')->name('module.themes');
        });

        //====================Website Page Setting==============================
        Route::controller(SettingsController::class)->group(function () {
            Route::put('/posting-rules', 'postingRulesUpdate')->name('admin.posting.rules.upadte');
            Route::put('/about', 'updateAbout')->name('admin.about.upadte');
            Route::put('/terms', 'updateTerms')->name('admin.terms.upadte');
            Route::put('/privacy', 'updatePrivacy')->name('admin.privacy.upadte');
        });

        //====================Website SEO Setting==============================
        Route::put('/seo', [SettingsController::class, 'updateSeo'])->name('admin.seo.update');

        //====================Website CMS Setting==============================
        Route::controller(CmsSettingController::class)->prefix('settings')->group(function () {
            Route::get('/cms', 'index')->name('settings.cms');
            Route::put('/home', 'updateHome')->name('admin.home.update');
            Route::put('/about', 'updateAbout')->name('admin.about.update');
            Route::put('/terms', 'updateTerms')->name('admin.terms.update');
            Route::get('/terms/store', 'updateTermsStore')->name('admin.terms.store');
            Route::put('/privacy', 'updatePrivacy')->name('admin.privacy.update');
            Route::get('/privacy/store', 'updatePrivacyStore')->name('admin.privacy.store');
            Route::put('/posting-rules', 'postingRulesUpdate')->name('admin.posting.rules.update');
            Route::put('/get-membership', 'updateGetMembership')->name('admin.getmembership.update');
            Route::put('/pricing-plan', 'updatePricingPlan')->name('admin.pricingplan.update');
            Route::put('/blog', 'updateBlog')->name('admin.blog.update');
            Route::put('/ads', 'updateAds')->name('admin.ads.update');
            Route::put('/contact', 'updateContact')->name('admin.contact.update');
            Route::put('/faq', 'updateFaq')->name('admin.faq.update');
            Route::put('/dashboard', 'updateDashboard')->name('admin.dashboard.update');
            Route::put('/auth-content', 'updateAuthContent')->name('admin.authcontent.update');
            Route::put('/coming-soon', 'updateComingSoon')->name('admin.comingsoon.update');
            Route::put('/maintenance', 'updateMaintenance')->name('admin.maintenance.update');
            Route::put('/errorpages', 'updateErrorPages')->name('admin.errorpages.update');
            Route::put('/footer-text', 'footerText')->name('admin.footer.text.update');
        });

        //====================Website CMS Setting==============================
        Route::prefix('ad-types')->group(function(){
            Route::get('/',[AdTypesController::class,'index'])->name('adtypes.index');
            Route::get('/create',[AdTypesController::class,'create'])->name('adtypes.create');
            Route::post('/store',[AdTypesController::class,'store'])->name('adtypes.store');
            Route::get('/edit/{slug}',[AdTypesController::class,'edit'])->name('adtypes.edit');
            Route::post('/update/{slug}',[AdTypesController::class,'update'])->name('adtypes.update');
            Route::delete('/delete/{id}',[AdTypesController::class,'delete'])->name('adtypes.delete');

        });

        Route::prefix('city')->group(function(){
            Route::get('/',[CityController::class,'index'])->name('city.index');
            Route::get('/create',[CityController::class,'create'])->name('city.create');
            Route::post('/store',[CityController::class,'store'])->name('city.store');
            Route::get('/edit/{id}',[CityController::class,'edit'])->name('city.edit');
            Route::post('/update/{id}',[CityController::class,'update'])->name('city.update');
            Route::delete('/delete/{id}',[CityController::class,'delete'])->name('city.delete');
        });

        //FAQ
        Route::prefix('faq')->group(function(){
            Route::get('/', [FaqController::class, 'index'])->name('faq.index');
            Route::get('/create', [FaqController::class, 'create'])->name('faq.create');
            Route::post('/store', [FaqController::class, 'store'])->name('faq.store');
            Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
            Route::post('/update/{id}', [FaqController::class, 'update'])->name('faq.update');
            Route::delete('/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
        });

        //Contact
        Route::prefix('user-contact')->group(function(){
            Route::get('/',[ContactController::class,'index'])->name('contact.index');
            Route::get('/view/{id}',[ContactController::class,'view'])->name('contact.view');
            Route::delete('/delete/{id}',[ContactController::class,'delete'])->name('contact.delete');
        });

        //User Transaction
        Route::prefix('user-transaction')->group(function(){
            Route::get('/',[TransactionController::class,'index'])->name('transaction.index');
            Route::get('/view/{id}',[TransactionController::class,'view'])->name('transaction.view');
            Route::delete('/delete/{id}',[TransactionController::class,'delete'])->name('transaction.delete');
        });

    });
});
