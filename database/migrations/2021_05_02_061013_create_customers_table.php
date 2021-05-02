<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('customer_id')->autoIncrement();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('current_street_number')->nullable();
            $table->string('current_street_name')->nullable();
            $table->string('current_street_type')->nullable();
            $table->string('current_suburb')->nullable();
            $table->string('current_state')->nullable();
            $table->integer('current_postcode')->nullable();
            $table->string('current_unit_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
