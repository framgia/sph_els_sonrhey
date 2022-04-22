<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
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
        CategoryModel::insert([
            [
                "title" => "Bisaya Category",
                "name" => "All About the Bisaya Categories"
            ],
            [
                "title" => "English Category",
                "name" => "All About the English Categories"
            ]
        ]);
        //
    }
}
