<?php

namespace Database\Seeders;

use App\Models\QuestionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    QuestionModel::insert([
      [
        'category_id' => 1,
        'description' => 'What is the Bisaya word of "Thank You"?'
      ],
      [
        'category_id' => 1,
        'description' => 'What is the Bisaya word of "People"?'
      ],
      [
        'category_id' => 1,
        'description' => 'What is the Bisaya word of "Time"?'
      ],
      [
        'category_id' => 1,
        'description' => 'What is the Bisaya word of "Child"?'
      ],
      [
        'category_id' => 1,
        'description' => 'What is the Bisaya word of "Know"?'
      ],
      [
        'category_id' => 2,
        'description' => 'What is the English word of "Wala ko Kasabot"?'
      ],
      [
        'category_id' => 2,
        'description' => 'What is the English word of "Unsa imong ngalan"?'
      ],
      [
        'category_id' => 2,
        'description' => 'What is the English word of "Salamat"?'
      ],
      [
        'category_id' => 2,
        'description' => 'What is the English word of "Tagpila"?'
      ],
      [
        'category_id' => 2,
        'description' => 'What is the English word of "Kita ta unya"?'
      ]
    ]);
      //
  }
}
