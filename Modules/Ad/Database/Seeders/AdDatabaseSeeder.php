<?php

namespace Modules\Ad\Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Database\Seeder;
use Modules\Brand\Entities\Brand;
use Modules\Ad\Entities\AdFeature;
use Modules\Ad\Entities\AdGallery;
use Illuminate\Database\Eloquent\Model;

class AdDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_list = json_decode(file_get_contents(base_path('public/dummy/products.json')), true);
        $faker = Factory::create();

        for ($i = 0; $i < count($product_list); $i++) {
            $product_data[] = [
                'title' => $product_list[$i]['title'],
                'slug' => Str::slug($product_list[$i]['title']),
                'thumbnail' => $product_list[$i]['image'],
                'user_id' => User::inRandomOrder()->value('id'),
                'category_id' => $product_list[$i]['category'],
                'subcategory_id' => $product_list[$i]['subcategory'] ?? null,
                'brand_id' => Brand::inRandomOrder()->value('id'),
                'price' => rand(200, 6000),
                'phone' => $faker->phoneNumber,
                'phone_2' => $faker->phoneNumber,
                'status' => Arr::random(["active", "sold", 'pending', 'declined','active','active','active','active','active']),
                'featured' => rand(true, false),
                'total_reports' => rand(1, 30),
                'total_views' => rand(1, 300),
                'is_blocked' => rand(true, false),
                'country' => $faker->country(),
                'lat' => $faker->latitude(-90, 90),
                'long' => $faker->longitude(-90, 90),
                'whatsapp' => Arr::random(['', "https://web.whatsapp.com"]),
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            ];

            for ($j=0; $j < count($product_list[$i]['gallery']); $j++) {
                $product_galleries[] = [
                    'key' => $i,
                    'image' => $product_list[$i]['gallery'][$j],
                ];
            }
        }

        foreach ($product_data as $key => $product) {
            $ad = Ad::create($product);

            foreach ($product_galleries as $product_gallery) {
                if ($product_gallery['key'] == $key) {
                    AdGallery::create([
                        'ad_id' => $ad->id,
                        'image' => $product_gallery['image'],
                    ]);
                }
            }
        }


        // AdGallery::factory(1000)->create();
        AdFeature::factory(200)->create();
    }
}
