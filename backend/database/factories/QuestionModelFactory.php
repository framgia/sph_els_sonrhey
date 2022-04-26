<?php

namespace Database\Factories;

use App\Models\CategoryModel;
use App\Models\QuestionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionModel>
 */
class QuestionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = QuestionModel::class;

    public function definition()
    {
        return [
            "category_id" => CategoryModel::factory(),
            "description" => $this->faker->word()
        ];
    }
}
