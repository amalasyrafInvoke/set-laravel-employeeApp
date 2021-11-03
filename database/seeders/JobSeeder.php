<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
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
      $job = new Job();
      $job->title = $faker->jobTitle;
      $job->description = $faker->text;
      $job->min_salary = $faker->randomFloat(2, 0, 10000);
      $job->max_salary = $faker->randomFloat(2, 10000, 30000);
      $job->save();
    }
  }
}
