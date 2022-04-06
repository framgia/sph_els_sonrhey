<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusModel;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusModel::insert([
            [
                'code' => 'INP',
                'name' => 'In Progress'
            ],
            [
                'code' => 'CMP',
                'name' => 'Completed'
            ],
            [
                'code' => 'CRR',
                'name' => 'Correct'
            ],
            [
                'code' => 'IRR',
                'name' => 'Incorrect'
            ]
        ]);
        //
    }
}
