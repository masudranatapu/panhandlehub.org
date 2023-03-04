<?php

namespace Modules\Faq\Database\factories;

use Modules\Faq\Entities\FaqCategory;
use Modules\Language\Entities\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Faq\Entities\Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'faq_category_id' => FaqCategory::inRandomOrder()->first()->id,
            'question' => $this->faker->text(10),
            'answer' => $this->faker->paragraph(1),
            'code' => Language::inRandomOrder()->value('code'),
        ];
    }
}
