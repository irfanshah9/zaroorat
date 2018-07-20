<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('car_mechanics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('car_m_name');
            $table->string('car_m_f_name');
            $table->string('car_m_phone_1');
            $table->string('car_m_phone_2');
            $table->text('car_m_location');
            $table->string('car_m_longitude');
            $table->string('car_m_latitude');
            $table->string('car_m_zip_code');
            $table->text('car_m_address');
            $table->string('car_m_description');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('car_mechanics');
    }
}
