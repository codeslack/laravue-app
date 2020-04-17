<?php

use App\Model\WalletRequest;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class WalletRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 50) as $index) {

            WalletRequest::create([
                'user_id'       => $faker->numberBetween(5, 10),
                'trans_date'    => $faker->unique()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'order_id'      => $faker->unique()->randomNumber($nbDigits = 8),
                'amount'        => $faker->numberBetween(500, 2000),
                'file_name'     => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
                'status_id'     => $faker->randomElement([1, 2, 3]),
                'remarks'       => $faker->name,

            ]);
        };
    }
}
