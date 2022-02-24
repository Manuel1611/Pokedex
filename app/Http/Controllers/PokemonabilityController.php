<?php

namespace App\Http\Controllers;

use App\Models\Pokemonability;
use App\Models\PokemonImage;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use App\Http\Requests\AbilityCreateRequest;
use App\Http\Requests\AbilityEditRequest;
use DB;
use Illuminate\Support\Facades\Storage;

class PokemonabilityController extends Controller
{
    public function __construct() {
        $this->middleware('verified');
        $this->middleware('exceptuser')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ability.index', ['abilities' => Pokemonability::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ability.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbilityCreateRequest $request)
    {
        $data = [];
        $data['message'] = 'Una nueva habilidad se ha añadido correctamente';
        $data['type'] = 'success';
        $ability = new Pokemonability($request->all());
        
        try {
            $result = $ability->save();   
        } catch(\Exception $e) {
            return back()->withInput();
        }
        if(!$result) {
            $data['message'] = 'La habilidad no puede ser añadida';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);  
        }
        return redirect('pokemonability')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemonability  $pokemonability
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemonability $pokemonability)
    {
        $data = [];
        $data['ability'] = $pokemonability;
        $data['pokemons'] = Pokemon::where('idability', $pokemonability->id)->get();
        $data['images'] = PokemonImage::all();
        return view('ability.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokemonability  $pokemonability
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokemonability $pokemonability)
    {
        return view('ability.edit', ['ability' => $pokemonability]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemonability  $pokemonability
     * @return \Illuminate\Http\Response
     */
    public function update(AbilityEditRequest $request, Pokemonability $pokemonability)
    {
        $data = [];
        $data['message'] = 'La habilidad ' . $pokemonability->name . ' se ha actualizado correctamente';
        $data['type'] = 'success';
        
        try {
            $result = $pokemonability->update($request->all());  
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'La habilidad no puede ser actualizada';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);  
        }
        return redirect('pokemonability')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemonability  $pokemonability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemonability $pokemonability)
    {
        $data = [];
        $data['message'] = 'La habilidad ' . $pokemonability->name . ' ha sido eliminada';
        $data['type'] = 'success';
        
        $pokemons = Pokemon::all();
        $id = $pokemonability->id;
        
        foreach($pokemons as $pokemon) {
            if($pokemon->idability == $pokemonability->id) {
                
                $images = PokemonImage::all();
                foreach($images as $image) {
                    if($image->idpokemon == $pokemon->id) {
                        $image->delete();
                        
                        $directory = '/public/images/' . $pokemon->id;
                        $response = Storage::deleteDirectory($directory);
                    }
                }
                
                $pokemon->delete();
            }
        }
        
        try {
            $pokemonability->delete();
        } catch(\Exception $e) {
            $data['message'] = 'La habilidad ' . $pokemonability->name . ' no ha podido ser eliminada';
            $data['type'] = 'danger';
        }
        return redirect('pokemonability')->with($data);
    }
}
