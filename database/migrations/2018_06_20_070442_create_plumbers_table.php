<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plumbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('p_name');
            $table->string('p_f_name');
            $table->string('p_phone_1');
            $table->string('p_phone_2');
            $table->string('p_shop');
            $table->text('p_location');
            $table->string('p_longitude');
            $table->string('p_latitude');
            $table->string('p_zip_code');
            $table->string('p_description');
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
        Schema::dropIfExists('plumbers');
    }
}
