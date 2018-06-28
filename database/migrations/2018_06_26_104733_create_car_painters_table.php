<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPaintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_painters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cp_name');
            $table->string('cp_f_name');
            $table->string('cp_phone_1');
            $table->string('cp_phone_2');
            $table->string('cp_shop');
            $table->text('cp_location');
            $table->string('cp_longitude');
            $table->string('cp_latitude');
            $table->string('cp_zip_code');
            $table->string('cp_description');
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
        Schema::dropIfExists('car_painters');
    }
}
