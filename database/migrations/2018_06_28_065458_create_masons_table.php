<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masons', function (Blueprint $table) {
           $table->increments('id');
            $table->string('m_name');
            $table->string('m_f_name');
            $table->string('m_phone_1');
            $table->string('m_phone_2');
            $table->text('m_location');
            $table->string('m_longitude');
            $table->string('m_latitude');
            $table->string('m_zip_code');
            $table->text('m_address');
            $table->string('m_description');
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
        Schema::dropIfExists('masons');
    }
}
