<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::insert([
      [
        "full_name" => "Super Admin",
        "email_address" => "superadmin@mailinator.com",
        "password" => bcrypt("Default@123"),
        "role_id" => 2
      ],
      [
        "full_name" => "John Doe",
        "email_address" => "johndoe@mailinator.com",
        "password" => bcrypt("Default@123"),
        "role_id" => 1
      ],
      [
        "full_name" => "Jane Doe",
        "email_address" => "janedoe@mailinator.com",
        "password" => bcrypt("Default@123"),
        "role_id" => 1
      ]
    ]);

    User::factory()
    ->count(5)
    ->create();
  }
}
