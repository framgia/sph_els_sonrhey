<?php

namespace Database\Factories;

use App\Models\ChoiceModel;
use App\Models\QuestionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChoiceModel>
 */
class ChoiceModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ChoiceModel::class;

    public function definition()
    {
        return [
            "question_id" => QuestionModel::factory(),
            "letter" => $this->faker->randomLetter(),
            "description" => $this->faker->word()
        ];
    }
}
