<?php

namespace Modules\Faq\Actions;

use Carbon\Carbon;

class UpdateFaq
{
    public static function update($request, $faq)
    {
        $faq->update([
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'code' => $request->code,
        ]);

        return $faq;
    }
}
