<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_code')->unique();
            $table->string('name')->unique();
            $table->unsignedBigInteger('service_group_id');
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->double('company', 15, 2)->default('0.00')->nullable();
            $table->double('state', 15, 2)->default('0.00')->nullable();
            $table->double('district', 15, 2)->default('0.00')->nullable();
            $table->double('block', 15, 2)->default('0.00')->nullable();
            $table->double('vendor', 15, 2)->default('0.00')->nullable();
            $table->double('referral', 15, 2)->default('0.00')->nullable();
            $table->double('retailer', 15, 2)->default('0.00')->nullable();
            $table->double('customer', 15, 2)->default('0.00')->nullable();
            $table->string('fixed_percent', 1)->default('f');
            $table->integer('sort_order')->unsigned()->default('0');
            $table->boolean('enabled')->default('1');
            $table->timestamps();

            $table->foreign('service_group_id')->references('id')->on('service_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_heads');
    }
}
