<?php

use App\Model\VoucherType;
use Illuminate\Database\Seeder;

class VoucherTypesTableSeeder extends Seeder
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
                'name' => 'Sales',
                'factor' => -1,
            ],
            [
                'name' => 'Purchase',
                'factor' => 1,
            ],
            [
                'name' => 'Receipt',
                'factor' => 0,
            ],
            [
                'name' => 'Payment',
                'factor' => 0,
            ],
            [
                'name' => 'Journal',
                'factor' => 0,
            ],
            [
                'name' => 'Debit Note',
                'factor' => 0,
            ],
            [
                'name' => 'Credit Note',
                'factor' => 0,
            ],
        ];

        foreach ($rows as $row) {
            VoucherType::create($row);
        }
    }
}
