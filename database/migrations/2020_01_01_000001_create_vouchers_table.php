<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('voucher_type_id');      // reference from voucher_type_id
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('order_id');             // reference from head account
            $table->unsignedBigInteger('account_id_one');       // buyer/seller/company id for debit
            $table->unsignedBigInteger('account_id_two');       // buyer/seller/company id for credit
            $table->date('trans_date');                         // transaction date
            $table->string('vch_no');                           // like Pay-1, Rec-1, Deb-1, Cre-1
            $table->string('name');
            $table->string('service_code');
            $table->text('remarks')->nullable();
            $table->double('amount', 15, 2)->default(0.00);
            $table->boolean('debit_credit')->default(0);        // debit = 0, credit = 1
            $table->text('notes')->nullable();  // Payment for Order No : 1596458755855 Dated : 23-06-2019
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('voucher_type_id')->references('id')->on('voucher_types');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('account_id_one')->references('id')->on('users');
            $table->foreign('account_id_two')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
