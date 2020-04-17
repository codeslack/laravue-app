<?php

use App\Model\DrivingLicence;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DrivingLicencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 1000) as $index) {

            DrivingLicence::create([
                'name' => $faker->name,
                'father_name' => $faker->name,
                'date_of_birth' => $faker->unique()->dateTimeBetween($startDate = '-50 years', $endDate = '-18 years')->format('Y-m-d'),
                'mobile_no' => $faker->unique()->randomNumber($nbDigits = 8),
                'address' => $faker->address,
                'buyer_id' => $faker->numberBetween(2, 10),
                'order_id' => $faker->unique()->randomNumber($nbDigits = 8),
                'amount' => $faker->numberBetween(1, 10),
                'avatar' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
                'service_code' => $faker->randomElement(['dl-mcwog', 'dl-mcwg', 'dl-lmv', 'dl-lmv-nt', 'dl-lmv-t', 'dl-renwl']),

            ]);
        };
    }
}
