<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');              // references user as buyer
            $table->date('trans_date');                         // transaction date
            $table->unsignedBigInteger('order_id');             // request order id
            $table->double('amount', 15, 2)->default(0.00);
            $table->string('file_name')->nullable();
            $table->Integer('status_id')->default('2');                // 2#process, 3#success, 5#reject
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_requests');
    }
}
