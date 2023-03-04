<?php

namespace App\Services\Admin\Cms;

use App\Models\CmsContent;

class PrivacyService
{
    public function index($request)
    {
        $privacy_page = $request->lang_query;
        $privacy_page_content = '';

        if ($privacy_page) {
            $privacy_page_content = CmsContent::where('translation_code', $privacy_page)
                ->where('page_slug', 'privacy_page')->first();
        }

        return $privacy_page_content;
    }
}
