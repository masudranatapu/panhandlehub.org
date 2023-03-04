<?php

namespace App\Services\Admin\Cms;

use App\Models\CmsContent;

class TermsService
{
    public function index($request)
    {
        $term_page = $request->lang_query;
        $term_page_content = '';

        if ($term_page) {
            $term_page_content = CmsContent::where('translation_code', $term_page)
                ->where('page_slug', 'terms_page')->first();
        }

        return $term_page_content;
    }
}
