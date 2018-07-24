<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lock_masters', function (Blueprint $table) {
           $table->increments('id');
            $table->string('lm_name');
            $table->string('lm_f_name');
            $table->string('lm_phone_1');
            $table->string('lm_phone_2');
            $table->string('lm_shop');
            $table->text('lm_location');
            $table->string('lm_longitude');
            $table->string('lm_latitude');
            $table->string('lm_zip_code');
            $table->text('lm_address');
            $table->string('lm_description');
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
        Schema::dropIfExists('lock_masters');
    }
}
