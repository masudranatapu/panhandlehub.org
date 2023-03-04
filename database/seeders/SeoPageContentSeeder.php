<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoPageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Seo::query()->delete();

        $pages = [
            [
                'page_slug' => 'home',
                'title' => 'Welcome To Adlisting'
            ],
            [
                'page_slug' => 'about',
                'title' => 'About'
            ],
            [
                'page_slug' => 'contact',
                'title' => 'About'
            ],
            [
                'page_slug' => 'ads',
                'title' => 'Ads'
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog'
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Pricing'
            ],
            [
                'page_slug' => 'login',
                'title' => 'Login'
            ],
            [
                'page_slug' => 'register',
                'title' => 'Register'
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ'
            ]
        ];

        foreach ($pages as $item) {
            $page =  Seo::create([
                'page_slug' => $item['page_slug'],
            ]);
            $page->contents()->create([
                'language_code' => 'en',
                'title' => $item['title'],
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ]);
        }
    }
}
