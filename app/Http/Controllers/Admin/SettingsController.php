<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Models\Cookies;
use App\Models\Setting;
use App\Models\Timezone;
use App\Traits\UploadAble;
use App\Mail\SmtpTestEmail;
use msztorc\LaravelEnv\Env;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use App\Models\ModuleSetting;
use App\Models\SeoPageContent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Services\Admin\Seo\SeoService;
use Illuminate\Support\Facades\Artisan;
use Modules\Currency\Entities\Currency;
use Modules\Language\Entities\Language;
use Modules\SetupGuide\Entities\SetupGuide;
use Spatie\Sitemap\Sitemap;

class SettingsController extends Controller
{
    use UploadAble;

    public function __construct()
    {
        $this->middleware(['permission:setting.view|setting.update'])->only(['website', 'layout', 'color', 'custom', 'email', 'system']);

        $this->middleware(['permission:setting.update'])->only([
            'websiteUpdate', 'layoutUpdate', 'colorUpdate', 'customCssJSUpdate',
            'modeUpdate', 'emailUpdate', 'testEmailSent',
        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function theme()
    {
        return view('admin.settings.pages.theme');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function custom()
    {
        return view('admin.settings.pages.custom');
    }

    /**
     * Update website layout
     *
     * @return void
     */
    public function layoutUpdate()
    {
        Setting::first()->update(request()->only('default_layout'));

        return back()->with('success', 'Website layout updated successfully!');
    }

    /**
     * color Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function colorUpdate()
    {
        Setting::first()->update(request()->only(['sidebar_color', 'nav_color', 'sidebar_txt_color', 'nav_txt_color', 'main_color', 'accent_color', 'frontend_primary_color', 'frontend_secondary_color']));

        SetupGuide::where('task_name', 'theme_setting')->update(['status' => 1]);

        return back()->with('success', 'Color setting updated successfully!');
    }

    /**
     * custom js and css Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function customCssJSUpdate()
    {
        Setting::first()->update(request()->only(['header_css', 'header_script', 'body_script']));

        return back()->with('success', 'Custom css/js updated successfully!');
    }

    /**
     * Mode Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function modeUpdate(Request $request)
    {
        $dark_mode = $request->only(['dark_mode']);
        Setting::first()->update($dark_mode);

        return back()->with('success', 'Theme updated successfully!');
    }

    public function email()
    {
        return view('admin.settings.pages.mail');
    }

    /**
     * Update mail configuration settings on .env file
     *
     * @param Request $request
     * @return void
     */
    public function emailUpdate(Request $request)
    {
        $request->validate([
            'mail_host'     =>  ['required',],
            'mail_port'     =>  ['required', 'numeric'],
            'mail_username'     =>  ['required',],
            'mail_password'     =>  ['required',],
            'mail_encryption'     =>  ['required',],
            'mail_from_name'     =>  ['required',],
            'mail_from_address'     =>  ['required', 'email'],
        ]);

        $data = $request->only(['mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_name', 'mail_from_address']);

        foreach ($data as $key => $value) {
            $env = new Env();
            $env->setValue(strtoupper($key), $value);
        }
        SetupGuide::where('task_name', 'smtp_setting')->update(['status' => 1]);

        return back()->with('success', 'Mail configuration update successfully');
    }


    /**
     * Send a test email for check mail configuration credentials
     *
     * @return void
     */
    public function testEmailSent()
    {
        request()->validate(['test_email' => ['required', 'email']]);
        try {
            Mail::to(request()->test_email)->send(new SmtpTestEmail);

            return back()->with('success', 'Test email sent successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid email configuration. Mail send failed.');
        }
    }

    /**
     * View Website mode page
     *
     * @return void
     */
    public function system()
    {
        $timezones = Timezone::all();
        $setting = Setting::first();
        $currencies = Currency::all();

        return view('admin.settings.pages.preference', compact('timezones', 'setting', 'currencies'));
    }

    public function systemUpdate(Request $request)
    {
        if ($request->app_mode == 'live') {
            setEnv('APP_MODE', $request->app_mode);
            $message = 'App is now live mode';
        } elseif ($request->app_mode == 'maintenance') {
            setEnv('APP_MODE', $request->app_mode);
            $message = 'App is in maintenance mode';
        } else {
            setEnv('APP_MODE', $request->app_mode);
            $message = 'App is in coming soon mode!';
        }

        flashSuccess($message);
        return redirect()->back();
    }

    public function cookies()
    {
        $cookie = Cookies::firstOrFail();

        return view('admin.settings.pages.cookies', compact('cookie'));
    }

    public function cookiesUpdate(Request $request)
    {
        // validating request data
        $request->validate([
            'cookie_name' => 'required|max:50|string',
            'cookie_expiration' => 'required|numeric|max:365',
            'title' => 'required',
            'description' => 'required',
            'approve_button_text' => 'required|string|max:30',
            'decline_button_text' => 'required|string|max:30',
        ]);

        // updating data to database
        $cookies = cookies();
        $cookies->allow_cookies = request('allow_cookies', 0);
        $cookies->cookie_name = $request->cookie_name;
        $cookies->cookie_expiration = $request->cookie_expiration;
        $cookies->force_consent = request('force_consent', 0);
        $cookies->darkmode = request('darkmode', 0);
        $cookies->title = $request->title;
        $cookies->approve_button_text = $request->approve_button_text;
        $cookies->decline_button_text = $request->decline_button_text;
        $cookies->description = $request->description;
        $cookies->save();

        // flashing success message and redirecting back
        flashSuccess('Cookies settings successfully updated!');
        return back();
    }

    public function seoIndex(Request $request, SeoService $seoService)
    {

        $data = $seoService->index($request);

        return view('admin.settings.pages.seo.index', $data);
    }

    /**
     * Seo Content Create
     *
     * @param $request
     * @return response
     */
    public function seoContentCreate(Request $request)
    {
        $seo = Seo::FindOrFail($request->page_id);
        $exist_content = $seo->contents()->where('language_code', $request->language_code)->first();
        $en_content = $seo->contents()->where('language_code', 'en')->first();

        $content = '';
        if ($exist_content) {
            $content = $exist_content;
        } else {
            $new_content = $seo->contents()->create([
                'language_code' => $request->language_code,
                'title' => $en_content->title,
                'description' => $en_content->description,
                'image' => $en_content->image,
            ]);
            $content = $new_content;
        }

        return redirect()->route('settings.seo.edit', [$seo->id, 'lang_query' => $content->language_code]);
    }

    public function seoEdit($page)
    {
        $seo = Seo::FindOrFail($page);
        $en_content = $seo->contents()->where('language_code', 'en')->first();

        if (request('lang_query')) { // if content is not exist then create
            $exist_content = $seo->contents()->where('language_code', request('lang_query'))->first();

            if (!$exist_content) {
                $new_content = $seo->contents()->create([
                    'language_code' => request('lang_query'),
                    'title' => $en_content->title,
                    'description' => $en_content->description,
                    'image' => $en_content->image,
                ]);
            }
        }

        if (request('lang_query')) {
            $content = $seo->contents()->where('language_code', request('lang_query'))->first();
        } else {
            $content = $seo->contents()->first();
        }

        $seo->load('contents');
        $languages = Language::get(['id', 'code', 'name']);

        $seo = Seo::FindOrFail($page);
        return view('admin.settings.pages.seo.edit', compact('seo', 'languages', 'content'));
    }

    /**
     * Seo Content Create
     *
     * @param $request
     * @return response
     */
    public function seoContentUpdate(Request $request, SeoPageContent $content)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);

        $content->update([
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
        ]);

        if ($request->image != null && $request->hasFile('image')) {
            deleteFile($content->image);

            $path = 'images/seo';
            $image = uploadImage($request->image, $path);

            $content->update([
                'image' => $image,
            ]);
        }

        flashSuccess('Page Meta Content Updated successfully');
        return redirect()->back();
    }

    /**
     * Seo Content Destroy
     *
     * @param $request
     * @return response
     */
    public function seoContentDelete(Request $request)
    {
        // $content = SeoPageContent::FindOrFail($request->content_id);
        // $content->delete();

        // flashSuccess('success', 'Page translation content delete successfully.');
        // return redirect()->route('settings.seo.edit', [$request->page_id, 'lang_query' => 'en']);
    }

    public function module()
    {
        $modulesetting = ModuleSetting::first();

        return view('admin.settings.pages.module', compact('modulesetting'));
    }

    public function moduleUpdate(Request $request)
    {
        $blog = $request->blog ?? false;
        $newsletter = $request->newsletter ?? false;
        $language = $request->language ?? false;
        $price_plan = $request->price_plan ?? false;
        $testimonial = $request->testimonial ?? false;
        $faq = $request->faq ?? false;
        $contact = $request->contact ?? false;
        $appearance = $request->appearance ?? false;

        ModuleSetting::first()->update([
            'blog' => $blog,
            'newsletter' => $newsletter,
            'language' => $language,
            'price_plan' => $price_plan,
            'testimonial' => $testimonial,
            'faq' => $faq,
            'contact' => $contact,
            'appearance' => $appearance,
        ]);

        flashSuccess('Module settings updated!');
        return back();
    }

    public function websiteConfigurationUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->linkdin = $request->linkdin;
        $setting->whatsapp = $request->whatsapp;
        $setting->save();

        flashSuccess('Website configuration updated!');
        return back();
    }

    /**
     *  Sitemap generator for xml
     *
     */
    public function generateSitemap()
    {
        flashSuccess('Not available with this version');
        return redirect()->back();
        // $sitemap = Sitemap::create()
        //     ->add(Url::create('/'))
        //     ->add(Url::create('/ad-list'))
        //     ->add(Url::create('/blog'))
        //     ->add(Url::create('/price-plan'))
        //     ->add(Url::create('/about'))
        //     ->add(Url::create('/contact'))
        //     ->add(Url::create('/login'))
        //     ->add(Url::create('/sign-up'))
        //     ->add(Url::create('/faq'))
        //     ->add(Url::create('/terms-conditions'))
        //     ->add(Url::create('/privacy'));
        // $sitemap->writeToFile(public_path('sitemap.xml'));

        // flashSuccess('Sitemap successfully created !');
    }

    /**
     * Upgrade application
     *
     * @return Response
     */
    public function upgrade()
    {
        return view('admin.settings.pages.upgrade-guide');
    }

    /**
     * Upgrade applying
     *
     * @return Response
     */
    public function upgradeApply()
    {
        Artisan::call("migrate");

        flashSuccess('Application Upgrade Successfully');
        return back();
    }
}
