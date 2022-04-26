<?php

namespace Database\Seeders;

use App\Models\AnswerModel;
use App\Models\CategoryModel;
use App\Models\ChoiceModel;
use App\Models\QuestionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_question_id = 0;

        $categories = CategoryModel::factory()
        ->count(4)
        ->create();

        foreach($categories as $category) {
            $questions = QuestionModel::factory()->count(4)->create([
                'category_id' => $category->category_id
            ]);

            foreach($questions as $question) {
                $choices = ChoiceModel::factory()->count(4)->create([
                    'question_id' => $question->question_id
                ]);

                foreach($choices as $choice) {
                    if ($old_question_id !== $choice->question_id) {
                        $choices = AnswerModel::factory()->count(1)->create([
                            'choice_id' => $choice->choice_id
                        ]);
                    }
                    $old_question_id = $question->question_id;
                }
            }
        }
    }
}
