<?php

namespace Modules\Faq\Actions;

use Modules\Faq\Entities\Faq;

class CreateFaq
{
    public static function create($request)
    {
        Faq::create([
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'code' => $request->code,
        ]);

        return true;
    }
}
