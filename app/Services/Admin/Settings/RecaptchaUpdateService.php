<?php

namespace App\Services\Admin\Settings;

use App\Models\Setting;

class RecaptchaUpdateService
{
    public function update($request){
        $request->validate([
            'nocaptcha_key' => 'required',
            'nocaptcha_secret' => 'required',
        ]);

        checkSetEnv('NOCAPTCHA_SITEKEY', $request->nocaptcha_key);
        checkSetEnv('NOCAPTCHA_SECRET', $request->nocaptcha_secret);
        setEnv('NOCAPTCHA_ACTIVE', $request->status ? 'true' : 'false');
    }
}
