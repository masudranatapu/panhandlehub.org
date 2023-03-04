<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Seeder;

class FooterTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cms = Cms::first();

        $cms->update([
            'footer_text' => '<strong> Copyright ' . date("Y") . ' <a href="http://templatecookie.com" target="_blank"> Templatecookie.com </a>.</strong>
            All Rights Reserved.'
        ]);
    }
}
