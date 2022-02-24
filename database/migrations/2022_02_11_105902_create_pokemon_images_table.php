<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_image', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idpokemon')->unsigned();
            $table->string('myname', 50);
            $table->string('mimetype', 20);
            $table->foreign('idpokemon')->references('id')->on('pokemon');
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
        Schema::dropIfExists('pokemon_image');
    }
}
