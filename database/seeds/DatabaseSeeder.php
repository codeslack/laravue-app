<?php

use App\Model\User;
use App\Model\PaymentType;
use App\Model\VoucherType;
use App\Model\ServiceGroup;
use Laravel\Passport\Passport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');


        User::truncate();
        ServiceGroup::truncate();
        PaymentType::truncate();
        VoucherType::truncate();


        User::flushEventListeners();
        ServiceGroup::flushEventListeners();
        PaymentType::flushEventListeners();
        VoucherType::flushEventListeners();


        $usersQuantity = 10;

        factory(User::class, $usersQuantity)->create();

        $this->call(ServiceGroupsTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(VoucherTypesTableSeeder::class);


        // Passport Clients

        Passport::client()->forceCreate([
            'user_id' => null,
            'name' => '',
            'secret' => 'secret',
            'redirect' => '',
            'personal_access_client' => true,
            'password_client' => true,
            'revoked' => false,
        ]);

        $personalClient = Passport::client()->forceCreate([
            'user_id' => null,
            'name' => '',
            'secret' => 'secret',
            'redirect' => '',
            'personal_access_client' => true,
            'password_client' => false,
            'revoked' => false,
        ]);

        Passport::personalAccessClient()->forceCreate([
            'client_id' => $personalClient->id,
        ]);
    }
}
