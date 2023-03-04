<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
                'image' => 'dummy/category/electronics.png',
                'icon' => 'fas fa-tv',
                'order' => 1,
            ],
            [
                'name' => 'Mobile Phone',
                'image' => 'dummy/category/mobile.png',
                'icon' => 'fas fa-mobile-alt',
                'order' => 2,
            ],
            [
                'name' => 'Vehicles',
                'image' => 'dummy/category/vehicles.png',
                'icon' => 'fas fa-car-alt',
                'order' => 3,
            ],
            [
                'name' => 'Sports & Kids',
                'image' => 'dummy/category/sports.png',
                'icon' => 'far fa-futbol',
                'order' => 4,
            ],
            [
                'name' => 'Home & Living',
                'image' => 'dummy/category/home-living.png',
                'icon' => 'fas fa-couch',
                'order' => 5,
            ],
            [
                'name' => 'Real State',
                'image' => 'dummy/category/real-estate.png',
                'icon' => 'far fa-building',
                'order' => 6,
            ],
        ];

        Category::insert($categories);
    }
}
