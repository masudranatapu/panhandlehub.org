<?php

namespace App\Services\Frontend;

use App\Models\Cms;
use App\Models\CmsContent;

class PrivacyPolicyService
{
    public function privacy(): array
    {
        $lang = currentLangCode() ?? 'en';
        $data['cms'] = Cms::select(['privacy_body', 'privacy_background'])->first();
        $data['privacy_content'] = '';

        if ($lang != 'en') {
            $get_content = CmsContent::where('page_slug', 'privacy_page')->where('translation_code', $lang)->first();
            if ($get_content) {
                $data['privacy_content'] = $get_content->text;
            } else {
                $get_content = Cms::select(['privacy_body'])->first();
                $data['privacy_content'] = $get_content->terms_body;
            }
        } else {
            $get_content = Cms::select(['privacy_body'])->first();
            $data['privacy_content'] = $get_content->terms_body;
        }

        return $data;
    }
}
