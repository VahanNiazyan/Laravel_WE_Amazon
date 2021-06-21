<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

//        foreach (range(1, 7) as $item) {
//            $user = [
//                'first_name' => $faker->word(),
//                'last_name' => $faker->word(),
//                'email' => $faker->word() . '@gmail.com',
//                'password' => Hash::make($faker->word())
//            ];
//            DB::table('users')->insert($user);
//        }

//        foreach (range(1, 7) as $item) {
            $user = [
                'first_name' => $faker->word(),
                'last_name' => $faker->word(),
                'email' => $faker->word() . '@gmail.com',
                'password' => Hash::make('11111111')
            ];
            DB::table('users')->insert($user);
//        }

    }
}
