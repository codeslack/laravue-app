<?php

use App\Model\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
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
                'name' => 'Cash',
                'code' => 'CAS',
            ],
            [
                'name' => 'Cheque',
                'code' => 'CHQ',
            ],
            [
                'name' => 'NEFT/RTGS',
                'code' => 'N/R',
            ],
            [
                'name' => 'Demand Draft',
                'code' => 'DD',
            ],
            [
                'name' => 'Pay Order',
                'code' => 'PAY',
            ],
            [
                'name' => 'Credit Card',
                'code' => 'CC',
            ],
            [
                'name' => 'Debit Card',
                'code' => 'DC',
            ],
            [
                'name' => 'Swipe',
                'code' => 'SW',
            ],
            [
                'name' => 'Google Pay',
                'code' => 'GPAY',
            ],
            [
                'name' => 'Phone Pay',
                'code' => 'PPAY',
            ],
            [
                'name' => 'Others',
                'code' => 'OTH',
            ],
            [
                'name' => 'Wallet',
                'code' => 'WLT',
            ],
        ];

        foreach ($rows as $row) {
            PaymentType::create($row);
        }
    }
}
