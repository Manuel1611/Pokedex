<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemontype extends Model
{
    use HasFactory;
    
    protected $table = 'pokemontype';
    
    protected $fillable = ['name', 'color'];
    
    protected $attributes = [];
    
    public function primarypokemons () {
        return $this->hasMany('App\Models\Pokemon', 'idprimarytype');
    }
    
    public function secondarypokemons () {
        return $this->hasMany('App\Models\Pokemon', 'idsecondarytype');
    }
}
