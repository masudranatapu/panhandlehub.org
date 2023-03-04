<?php

namespace App\Services\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Modules\Currency\Http\Controllers\CurrencyController;
use Modules\Language\Http\Controllers\TranslationController;

class AppConfigService
{
    public function update($request){
        $request->validate([
            'free_ad_limit' => 'required|numeric',
            'free_featured_ad_limit' => 'required|numeric',
            'maximum_ad_image_limit' => 'required|numeric',
            'subscription_type' => 'required',
        ]);

        if ($request->has('timezone')) {
            $this->timezone($request);
        }

        if ($request->has('code')) {
            (new TranslationController())->setDefaultLanguage($request);
        }

        if ($request->app_debug == 1) {
            Artisan::call('env:set APP_DEBUG=true');
        } else {
            Artisan::call('env:set APP_DEBUG=false');
        }

        if ($request->has('currency')) {
            (new CurrencyController())->defaultCurrency($request);
        }

        $setting = Setting::first();
        $setting->email_verification = $request->email_verification ? true : false;
        $setting->website_loader = $request->website_loader ?? false;
        $setting->regular_ads_homepage = $request->regular_ads_homepage ?? false;
        $setting->featured_ads_homepage = $request->featured_ads_homepage ?? false;
        $setting->customer_email_verification = $request->customer_email_verification ?? false;
        $setting->ads_admin_approval = $request->ads_admin_approval ?? false;
        $setting->language_changing = $request->language_changing ?? false;
        $setting->currency_changing = $request->currency_changing ?? false;
        $setting->free_ad_limit = $request->free_ad_limit;
        $setting->free_featured_ad_limit = $request->free_featured_ad_limit;
        $setting->maximum_ad_image_limit = $request->maximum_ad_image_limit;
        $setting->subscription_type = $request->subscription_type;
        $setting->save();
    }

    public function timezone($request)
    {
        $request->validate(['timezone' => "required"]);

        $timezone = $request->timezone;

        if ($timezone && $timezone != config('app.timezone')) {
            envReplace('APP_TIMEZONE', $timezone);

            flashSuccess('Timezone Updated Successfully!');
        }
    }
}
