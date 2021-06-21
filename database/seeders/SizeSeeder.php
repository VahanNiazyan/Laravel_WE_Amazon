<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach(range(1, 7) as $item){
            DB::table('sizes')->insert(
                ['size' => $faker->numberBetween($min = 10, $max = 100).'',]
            );
        }
    }
}
