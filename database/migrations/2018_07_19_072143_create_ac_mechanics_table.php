<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_mechanics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ac_m_name');
            $table->string('ac_m_f_name');
            $table->string('ac_m_phone_1');
            $table->string('ac_m_phone_2');
             $table->string('ac_m_shop');
            $table->text('ac_m_location');
            $table->string('ac_m_longitude');
            $table->string('ac_m_latitude');
            $table->string('ac_m_zip_code');
            $table->text('ac_m_address');
            $table->string('ac_m_description');
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
        Schema::dropIfExists('ac_mechanics');
    }
}
