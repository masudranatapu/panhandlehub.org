<?php

namespace App\Providers;

use App\Models\AdType;
use App\Models\Cms;
use App\Models\Country;
use App\Models\Setting;
use App\Models\ModuleSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Currency\Entities\Currency;
use Modules\Language\Entities\Language;
use Illuminate\Support\Facades\Validator;
use Modules\MobileApp\Entities\MobileAppConfig;
use Modules\Category\Transformers\CategoryResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (!app()->runningInConsole()) {
            $setting = Setting::first();
            $languages = Language::all();
            view()->share('setting', $setting);
            view()->share('languages', $languages);

            $moduleSetting = ModuleSetting::first();
            if ($moduleSetting) {
                view()->share('blog_enable', $moduleSetting->blog);
                view()->share('newsletter_enable', $moduleSetting->newsletter);
                view()->share('contact_enable', $moduleSetting->contact);
                view()->share('faq_enable', $moduleSetting->faq);
                view()->share('testimonial_enable', $moduleSetting->testimonial);
                view()->share('priceplan_enable', $moduleSetting->price_plan);
                view()->share('language_enable', $moduleSetting->language);
                view()->share('appearance_enable', $moduleSetting->appearance);
           }

           view()->share('top_categories', CategoryResource::collection(Category::active()->withCount('ads as ad_count')->latest('ad_count')->take(8)->get()));
           view()->share('footer_categories', Category::active()->latest()->take(4)->get());
           view()->share('categories', Category::active()->with('subcategories', function ($q) {
             $q->where('status', 1);
           })->get());
           view()->share('countries', Country::all());
           view()->share('ad_types', AdType::all());
           view()->share('settings', Setting::first());
           view()->share('cms', Cms::first());
           view()->share('languages', Language::all(['id', 'name', 'code', 'icon']));
           view()->share('mobile_setting', MobileAppConfig::first());
           view()->share('headerCurrencies', Currency::all());

           //Add this custom validation rule.
           Validator::extend('alpha_spaces', function ($attribute, $value) {
               return preg_match('/^[\pL\s]+$/u', $value);
           });

        }
    }
}
