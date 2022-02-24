<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonImage extends Model
{
    use HasFactory;
    
    protected $table = 'pokemon_image';
    
    protected $fillable = ['idpokemon', 'myname', 'mimetype'];
    
    protected $attributes = ['myname' => null, 'mimetype' => null];
    
    public function pokemons () {
        return $this->hasMany('App\Models\Pokemon', 'id');
    }
}
