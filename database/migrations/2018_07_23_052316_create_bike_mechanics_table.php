<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikeMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_mechanics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bike_m_name');
            $table->string('bike_m_f_name');
            $table->string('bike_m_phone_1');
            $table->string('bike_m_phone_2');
            $table->string('bike_m_shop');
            $table->text('bike_m_location');
            $table->string('bike_m_longitude');
            $table->string('bike_m_latitude');
            $table->string('bike_m_zip_code');
            $table->text('bike_m_address');
            $table->string('bike_m_description');
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
        Schema::dropIfExists('bike_mechanics');
    }
}
