<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivingLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_licences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('father_name');
            $table->date('date_of_birth');
            $table->string('mobile_no');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->boolean('enabled')->default('0');   // lock or unlock for user can edit
            $table->unsignedBigInteger('buyer_id');      // references user as buyer
            $table->unsignedBigInteger('order_id');                 // request order id
            $table->string('service_code');             // service apply code
            $table->double('amount', 15, 2)->default('0.00');
            $table->string('avatar')->default('avatar.png');
            $table->timestamps();

            $table->index('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driving_licences');
    }
}
