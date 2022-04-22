<?php

namespace Database\Seeders;

use App\Models\ChoiceModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChoiceModel::insert([
            [
                "question_id" => 1,
                "letter" => "A",
                "description" => "Ambot Lang"
            ],
            [
                "question_id" => 1,
                "letter" => "B",
                "description" => "Salamat"
            ],
            [
                "question_id" => 1,
                "letter" => "C",
                "description" => "Salamat sa tanan"
            ],
            [
                "question_id" => 1,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 2,
                "letter" => "A",
                "description" => "Ambot Lang"
            ],
            [
                "question_id" => 2,
                "letter" => "B",
                "description" => "wa ko kahibaw"
            ],
            [
                "question_id" => 2,
                "letter" => "C",
                "description" => "Katawhan"
            ],
            [
                "question_id" => 2,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 3,
                "letter" => "A",
                "description" => "Oras"
            ],
            [
                "question_id" => 3,
                "letter" => "B",
                "description" => "Salamat"
            ],
            [
                "question_id" => 3,
                "letter" => "C",
                "description" => "Katawhan"
            ],
            [
                "question_id" => 3,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 4,
                "letter" => "A",
                "description" => "Ambot Lang"
            ],
            [
                "question_id" => 4,
                "letter" => "B",
                "description" => "Bata"
            ],
            [
                "question_id" => 4,
                "letter" => "C",
                "description" => "Tigulang"
            ],
            [
                "question_id" => 4,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 5,
                "letter" => "A",
                "description" => "Ambot Lang"
            ],
            [
                "question_id" => 5,
                "letter" => "B",
                "description" => "Salamat"
            ],
            [
                "question_id" => 5,
                "letter" => "C",
                "description" => "Kahibaw"
            ],
            [
                "question_id" => 5,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 6,
                "letter" => "A",
                "description" => "I don't know"
            ],
            [
                "question_id" => 6,
                "letter" => "B",
                "description" => "Thank you"
            ],
            [
                "question_id" => 6,
                "letter" => "C",
                "description" => "Take care"
            ],
            [
                "question_id" => 6,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 7,
                "letter" => "A",
                "description" => "What is your name?"
            ],
            [
                "question_id" => 7,
                "letter" => "B",
                "description" => "Thank you"
            ],
            [
                "question_id" => 7,
                "letter" => "C",
                "description" => "Are you ok?"
            ],
            [
                "question_id" => 7,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 8,
                "letter" => "A",
                "description" => "I don't know"
            ],
            [
                "question_id" => 8,
                "letter" => "B",
                "description" => "Thank you"
            ],
            [
                "question_id" => 8,
                "letter" => "C",
                "description" => "Go ahead"
            ],
            [
                "question_id" => 8,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 9,
                "letter" => "A",
                "description" => "How much"
            ],
            [
                "question_id" => 9,
                "letter" => "B",
                "description" => "I will buy"
            ],
            [
                "question_id" => 9,
                "letter" => "C",
                "description" => "No way"
            ],
            [
                "question_id" => 9,
                "letter" => "D",
                "description" => "None of the above"
            ],
            [
                "question_id" => 10,
                "letter" => "A",
                "description" => "Thank you"
            ],
            [
                "question_id" => 10,
                "letter" => "B",
                "description" => "See you later"
            ],
            [
                "question_id" => 10,
                "letter" => "C",
                "description" => "See you tomorrow"
            ],
            [
                "question_id" => 10,
                "letter" => "D",
                "description" => "None of the above"
            ]
        ]);
        //
    }
}
