<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labours', function (Blueprint $table) {
          $table->increments('id');
            $table->string('l_name');
            $table->string('l_f_name');
            $table->string('l_phone_1');
            $table->string('l_phone_2');
            $table->text('l_location');
            $table->string('l_longitude');
            $table->string('l_latitude');
            $table->string('l_zip_code');
            $table->text('l_address');
            $table->string('l_description');
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
        Schema::dropIfExists('labours');
    }
}
