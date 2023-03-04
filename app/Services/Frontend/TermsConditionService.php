<?php

namespace App\Services\Frontend;

use App\Models\Cms;
use App\Models\CmsContent;

class TermsConditionService
{
    public function terms(): array
    {
        $lang = currentLangCode() ?? 'en';
        $data['cms'] = Cms::select(['terms_body', 'terms_background'])->first();
        $data['terms_content'] = '';

        if ($lang != 'en') {
            $get_content = CmsContent::where('page_slug', 'terms_page')->where('translation_code', $lang)->first();
            if ($get_content) {
                $data['terms_content'] = $get_content->text;
            }else{
                $get_content = Cms::select(['terms_body'])->first();
                $data['terms_content'] = $get_content->terms_body;
            }
        } else {
            $get_content = Cms::select(['terms_body'])->first();
            $data['terms_content'] = $get_content->terms_body;
        }

        return $data;
    }
}
