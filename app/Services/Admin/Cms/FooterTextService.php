<?php

namespace App\Services\Admin\Cms;

use App\Models\Cms;

class FooterTextService
{
    public function update(Object $request): void
    {
        session(['cms_part' => 'footer_text']);

        $cms =  Cms::first();
        $cms->update([
            'footer_text' => $request->footer_text
        ]);
    }
}
