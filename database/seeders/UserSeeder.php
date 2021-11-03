<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $faker = Faker::create();

    foreach (range(1, 50) as $index) {
      //this one insert date when run the save() function;
      $user = new User();
      $user->name = $faker->name;
      $user->email = $faker->email;
      $user->password = bcrypt('12345');
      $user->role = 0;
      $user->save();
    }
  }
}
