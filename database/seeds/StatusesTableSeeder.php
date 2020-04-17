<?php

use App\Model\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'cat_id' => 1,
                'name' => 'processing',
                'color' => '#00a3f3',
            ],
            [
                'cat_id' => 1,
                'name' => 'rejected',
                'color' => '#ed790d',
            ],
            [
                'cat_id' => 1,
                'name' => 'success',
                'color' => '#2f8912',
            ],

            [
                'cat_id' => 4,
                'name' => 'Entry',
                'color' => '#507196',
            ],
            [
                'cat_id' => 4,
                'name' => 'In-Prograss',
                'color' => '#6cacd2',
            ],
            [
                'cat_id' => 4,
                'name' => 'success',
                'color' => '#2f8912',
            ],
            [
                'cat_id' => 4,
                'name' => 'hold',
                'color' => '#ec8d37',
            ],
            [
                'cat_id' => 4,
                'name' => 'rejected',
                'color' => '#fb0006',
            ],
            [
                'cat_id' => 4,
                'name' => 'open',
                'color' => '#c259e6',
            ],
        ];

        foreach ($rows as $row) {
            Status::create($row);
        }
    }
}
