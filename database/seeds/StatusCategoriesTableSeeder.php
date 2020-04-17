<?php

use App\Model\StatusCategory;
use Illuminate\Database\Seeder;

class StatusCategoriesTableSeeder extends Seeder
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
                'name' => 'wallet',
            ],
            [
                'name' => 'payment',
            ],
            [
                'name' => 'receipt',
            ],
            [
                'name' => 'driving licence',
            ],
            [
                'name' => 'digital card printing',
            ],
        ];

        foreach ($rows as $row) {
            StatusCategory::create($row);
        }
    }
}
