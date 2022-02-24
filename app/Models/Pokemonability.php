<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemonability extends Model
{
    use HasFactory;
    
    protected $table = 'pokemonability';
    
    protected $fillable = ['name', 'battleeffect', 'outsideeffect'];
    
    protected $attributes = [];
    
    public function pokemons () {
        return $this->hasMany('App\Models\Pokemon', 'idability');
    }
}
