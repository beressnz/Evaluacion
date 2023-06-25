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
        Schema::create('producto_traducciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('producto_id');
            $table->string('nombre');
            $table->string('descripcion_corta');
            $table->string('descripcion_larga')->nullable();
            $table->string('url');
            $table->string('idioma');
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
        Schema::dropIfExists('producto_traducciones');
    }
};
