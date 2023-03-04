<?php

namespace App\Services\Admin\Seo;

use App\Models\Seo;
use Modules\Language\Entities\Language;

class SeoService
{
    public function index($request)
    {
        $query = $request->lang_query;
        $data['seos'] = Seo::with(['contents' => function ($q) use ($query) {

            if ($query) {
                return $q->whereIn('language_code', [$query, 'en']);
            } else {
                return $q->where('language_code', 'en');
            }
        }])->paginate(20);

        $data['languages'] = Language::get(['id', 'code', 'name']);

        return $data;
    }
}
