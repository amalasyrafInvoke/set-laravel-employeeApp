<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
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
      $department = new Department();
      $department->name = $faker->safeColorName;
      $department->save();
    }
  }
}
