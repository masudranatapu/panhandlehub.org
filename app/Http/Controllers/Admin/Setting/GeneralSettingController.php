<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use App\Models\Timezone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Currency\Entities\Currency;
use Modules\SetupGuide\Entities\SetupGuide;
use App\Services\Admin\Settings\AppConfigService;
use App\Services\Admin\Settings\BroadcastUpdateService;
use App\Services\Admin\Settings\RecaptchaUpdateService;
use App\Services\Admin\Settings\WatermarkUpdateService;

class GeneralSettingController extends Controller
{
     /**
     * General Settings View
     *
     * @return void
     */
    public function general()
    {
        $setting = Setting::first();

        return view('admin.settings.pages.general.basic', compact( 'setting'));
    }

     /**
     * Website Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function generalUpdate(Request $request)
    {
        $request->validate([
            'name'      =>  ['required'],
            'logo_image'      =>  ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:3072'],
            'white_logo'      =>  ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:3072'],
            'favicon_image'      =>  ['nullable', 'mimes:png,ico', 'max:1024'],
        ]);

        if ($request->name && $request->name != env('APP_NAME')) {
            setEnv('APP_NAME', $request->name);
        }

        $setting = Setting::first();
        if ($request->hasFile('logo_image')) {
            $setting['logo_image'] = uploadFileToPublic($request->logo_image, 'app/logo');
            deleteFile($setting->logo_image);
        }

        if ($request->hasFile('white_logo')) {
            $setting['white_logo'] = uploadFileToPublic($request->white_logo, 'app/logo');
            deleteFile($setting->white_logo);
        }

        if ($request->hasFile('favicon_image')) {
            $setting['favicon_image'] = uploadFileToPublic($request->favicon_image, 'app/logo');
            deleteFile($setting->favicon_image);
        }

        $setting->save();
        SetupGuide::where('task_name', 'app_setting')->update(['status' => 1]);

        return back()->with('success', 'Website setting updated successfully!');
    }

    /**
     * App Configuration Settings View
     *
     * @return void
     */
    public function appConfig()
    {
        $timezones = Timezone::all();
        $setting = Setting::first();
        $currencies = Currency::all();

        return view('admin.settings.pages.general.app', compact('timezones', 'setting', 'currencies'));
    }

    /**
     * App Configuration Settings Update
     *
     * @return void
     */
    public function appConfigUpdate(Request $request, AppConfigService $appConfigService)
    {
        $appConfigService->update($request);

        flashSuccess('App Configuration Updated!');
        return redirect()->back();
    }

    /**
     * Watermark Configuration Settings View
     *
     * @return void
     */
    public function watermark()
    {
        return view('admin.settings.pages.general.watermark-ads');
    }

    /**
     * Watermark Configuration Settings Update
     *
     * @return void
     */
    public function watermarkUpdate(Request $request, WatermarkUpdateService $watermarkUpdateService)
    {
        $watermarkUpdateService->update($request);

        flashSuccess('Watermark data updated !');

        return redirect()->back();
    }

    /**
     * App Configuration Settings View
     *
     * @return void
     */
    public function recaptcha()
    {
        return view('admin.settings.pages.general.recaptcha');
    }

    public function recaptchaUpdate(Request $request, RecaptchaUpdateService $recaptchaUpdateService)
    {
        $recaptchaUpdateService->update($request);

        flashSuccess('Recaptcha Configuration updated!');
        return back();
    }

    /**
     * Broadcast Settings View
     *
     * @return void
     */
    public function broadcasting()
    {
        return view('admin.settings.pages.general.broadcast');
    }

     /**
     * Broadcast Settings Update
     *
     * @return void
     */
    public function broadcastingUpdate(Request $request, BroadcastUpdateService $broadcastUpdateService)
    {
        $broadcastUpdateService->update($request);

        SetupGuide::where('task_name', 'pusher_setting')->update(['status' => 1]);

        flashSuccess('Pusher Configuration updated!');
        return back();
    }
}
