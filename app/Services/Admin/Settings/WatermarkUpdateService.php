<?php

namespace App\Services\Admin\Settings;

use App\Models\Setting;

class WatermarkUpdateService
{
    public function update($request){
        $setting = Setting::first();
        $setting->update([
            'watermark_status' => $request->watermark_status ? true : false,
            'watermark_type' => $request->watermark_type,
        ]);

        $request->validate([
            'watermark_type' => 'required',
        ]);

        if ($request->watermark_type == 'text') {

            $request->validate([
                'text' => 'required|max:32'
            ]);

            $setting = Setting::first();
            $setting->update([
                'watermark_text' => $request->text,
            ]);
        } else {

            if ($request->hasFile('image')) {

                $oldImg = $setting->watermark_image;
                if (file_exists($oldImg)) {
                    if (!'frontend/image/logo.png') {
                        unlink($oldImg);
                    }
                }

                $image = uploadImage($request->image, 'watermark');

                $setting->update([
                    'watermark_image' => $image,
                ]);
            }
        }
    }
}
