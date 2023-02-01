<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_llamada_id');
            $table->unsignedInteger('origen_llamada_id');
            $table->string('nombre');
            $table->string('telefono', 8);
            $table->string('gestion');

            $table->timestamps();
            $table->foreign('tipo_llamada_id')->references('id')->on('tipo_llamadas')->onDelete('cascade');
            $table->foreign('origen_llamada_id')->references('id')->on('origen_llamadas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gestions');
    }
};
