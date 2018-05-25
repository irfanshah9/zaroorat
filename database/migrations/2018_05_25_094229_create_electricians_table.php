<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectriciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electricians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('e_name');
            $table->string('e_f_name');
            $table->string('e_phone_1');
            $table->string('e_phone_2');
            $table->string('e_location');
            $table->string('e_description');
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
        Schema::dropIfExists('electricians');
    }
}
