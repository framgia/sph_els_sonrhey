<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleModel;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleModel::insert([
            [
                'code' => 'STD',
                'name' => 'Student'
            ],
            [
                'code' => 'SA',
                'name' => 'Super Admin'
            ]
        ]);
        //
    }
}
