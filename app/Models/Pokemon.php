<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    
    protected $table = 'pokemon';
    
    protected $fillable = ['idprimarytype', 'idsecondarytype', 'idability', 'name', 'height', 'weight', 'description', 'region'];
    
    protected $attributes = ['idsecondarytype' => null];
    
    public function pokemonprimarytype () {
        return $this->belongsTo('App\Models\Pokemontype', 'idprimarytype');
    }
    
    public function pokemonsecondarytype () {
        return $this->belongsTo('App\Models\Pokemontype', 'idsecondarytype');
    }
    
    public function pokemonability () {
        return $this->belongsTo('App\Models\Pokemonability', 'idability');
    }
}