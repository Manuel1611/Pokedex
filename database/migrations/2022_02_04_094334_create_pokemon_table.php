<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idprimarytype')->unsigned();
            $table->bigInteger('idsecondarytype')->unsigned()->nullable();
            $table->bigInteger('idability')->unsigned();
            $table->string('name', 25)->unique();
            $table->double('height', 8, 2);
            $table->double('weight', 8, 2);
            $table->string('description', 200);
            $table->enum('region', ['Kanto', 'Johto', 'Hoenn', 'Sinnoh', 'Teselia', 'Kalos', 'Alola', 'Galar']);
            $table->timestamps();
            $table->foreign('idprimarytype')->references('id')->on('pokemontype');
            $table->foreign('idsecondarytype')->references('id')->on('pokemontype');
            $table->foreign('idability')->references('id')->on('pokemonability');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon');
    }
}
