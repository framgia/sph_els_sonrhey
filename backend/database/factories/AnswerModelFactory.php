<?php

namespace Database\Factories;

use App\Models\AnswerModel;
use App\Models\ChoiceModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnswerModel>
 */
class AnswerModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AnswerModel::class;
    
    public function definition()
    {
        return [
            //
        ];
    }
}
