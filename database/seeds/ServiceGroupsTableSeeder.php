<?php

use App\Model\ServiceGroup;
use Illuminate\Database\Seeder;

class ServiceGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'code' => 'dl',
                'name' => 'Driving Licence',
            ],
            [
                'code' => 'dsc',
                'name' => 'digital card printing',
            ],
            [
                'code' => 'app',
                'name' => 'appointment',
            ],
        ];

        foreach ($rows as $row) {
            ServiceGroup::create($row);
        }
    }
}
