<?php

namespace App\Http\Controllers;

use App\Models\Pokemontype;
use App\Models\PokemonImage;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use App\Http\Requests\TypeCreateRequest;
use App\Http\Requests\TypeEditRequest;
use DB;
use Illuminate\Support\Facades\Storage;

class PokemontypeController extends Controller
{
    
    public function __construct() {
        $this->middleware('verified');
        $this->middleware('exceptuser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('type.index', ['types' => Pokemontype::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeCreateRequest $request)
    {
        $data = [];
        $data['message'] = 'Un nuevo tipo se ha añadido correctamente';
        $data['type'] = 'success';
        $type = new Pokemontype($request->all());
        
        try {
            $result = $type->save();   
        } catch(\Exception $e) {
            return back()->withInput();
        }
        if(!$result) {
            $data['message'] = 'El tipo no puede ser añadido';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);  
        }
        return redirect('pokemontype')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemontype  $pokemontype
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemontype $pokemontype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokemontype  $pokemontype
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokemontype $pokemontype)
    {
        return view('type.edit', ['type' => $pokemontype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemontype  $pokemontype
     * @return \Illuminate\Http\Response
     */
    public function update(TypeEditRequest $request, Pokemontype $pokemontype)
    {
        $data = [];
        $data['message'] = 'El tipo ' . $pokemontype->name . ' se ha actualizado correctamente';
        $data['type'] = 'success';
        
        try {
            $result = $pokemontype->update($request->all());  
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El tipo no puede ser actualizado';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);  
        }
        return redirect('pokemontype')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemontype  $pokemontype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemontype $pokemontype)
    {
        $data = [];
        $data['message'] = 'El tipo ' . $pokemontype->name . ' ha sido eliminado';
        $data['type'] = 'success';
        
        $pokemons = Pokemon::all();
        $id = $pokemontype->id;
        
        foreach($pokemons as $pokemon) {
            if($pokemon->idprimarytype == $pokemontype->id) {
                
                $images = PokemonImage::all();
                foreach($images as $image) {
                    if($image->idpokemon == $pokemon->id) {
                        $image->delete();
                        
                        $directory = '/public/images/' . $pokemon->id;
                        $response = Storage::deleteDirectory($directory);
                    }
                }
                
                $pokemon->delete();
                
            } else if ($pokemon->idsecondarytype == $pokemontype->id) {
                DB::table('pokemon')->where("pokemon.idsecondarytype", '=',  $id)
                    ->update(['pokemon.idsecondarytype' => null]);
            }
        }
        
        try {
            $pokemontype->delete();
        } catch(\Exception $e) {
            $data['message'] = 'El tipo ' . $pokemontype->name . ' no ha podido ser eliminado';
            $data['type'] = 'danger';
        }
        return redirect('pokemontype')->with($data);
    }
}
