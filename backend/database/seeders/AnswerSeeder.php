<?php

namespace Database\Seeders;

use App\Models\AnswerModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    AnswerModel::insert([
      [
        'choice_id' => 2
      ],
      [
        'choice_id' => 7
      ],
      [
        'choice_id' => 9
      ],
      [
        'choice_id' => 14
      ],
      [
        'choice_id' => 19
      ],
      [
        'choice_id' => 21
      ],
      [
        'choice_id' => 25
      ],
      [
        'choice_id' => 30
      ],
      [
        'choice_id' => 33
      ],
      [
        'choice_id' => 38
      ]
    ]);
      //
  }
}
