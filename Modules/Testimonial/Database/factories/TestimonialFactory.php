<?php

namespace Modules\Testimonial\Database\factories;

use Modules\Language\Entities\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Testimonial\Entities\Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->name(2);
        $position = $this->faker->jobTitle;

        return [
            'name' => $title,
            'position' => $position,
            'description' => $this->faker->paragraph,
            'stars' => rand(1,5),
            'image' => $this->faker->imageUrl,
            'code' => Language::inRandomOrder()->first()->code,
        ];
    }
}
