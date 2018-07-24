<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGasMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_mechanics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gas_m_name');
            $table->string('gas_m_f_name');
            $table->string('gas_m_phone_1');
            $table->string('gas_m_phone_2');
            $table->string('gas_m_shop');
            $table->text('gas_m_location');
            $table->string('gas_m_longitude');
            $table->string('gas_m_latitude');
            $table->string('gas_m_zip_code');
            $table->text('gas_m_address');
            $table->string('gas_m_description');
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
        Schema::dropIfExists('gas_mechanics');
    }
}
