<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Pokemontype;
use App\Models\Pokemonability;
use App\Models\PokemonImage;
use Illuminate\Http\Request;
use App\Http\Requests\PokemonCreateRequest;
use App\Http\Requests\PokemonEditRequest;
use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
    private $valor;
    
    public function __construct() {
        $this->middleware('verified');
        $this->middleware('exceptuser')->except(['index', 'show']);
    }
    
    private function verifySort($sort) {
        if($sort == null) {
            return $sort;
        } else if($sort == 'id') {
            return $sort;
        } else if($sort == 'name') {
            return $sort;
        }
        return null;
    }
    
    private function verifyOrder($order) {
        if($order == null) {
            return $order;
        } else if($order == 'desc') {
            return $order;
        } else {
            return 'asc';
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filtertype = $request->input('filtertype');
        $data = [];
        
        $pokemon = new Pokemon();
        $sort = $this->verifySort($request->input('sort'));
        $order = $this->verifyOrder($request->input('order'));
        $sortData = [];
        $appendData = [];
        $searchData = [];
        
        if($search != null) {
            $pokemon = $pokemon->where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%');
        }
        
        if($filtertype != null && $filtertype > 0) {
            $this->valor = $filtertype;
            $pokemon = $pokemon->where(function($where) {
                $where->where('idprimarytype', $this->valor)->orWhere('idsecondarytype', $this->valor);
            });
        }
        
        if($sort != null && $order != null) {
            $pokemon = $pokemon->orderBy($sort, $order);
            $sortData = [
                'sort' => $sort,
                'order' => $order,
            ];
        }
        
        if($search != null) {
            $searchData['search'] = $search;
        }
        
        $appendData['filtertype'] = 0;
        if($filtertype != null) {
            $appendData['filtertype'] = $filtertype;
        }
        
        $data['orderidasc'] = ['sort' => 'id', 'order' => 'asc', 'search' => $search, 'filtertype' => $filtertype];
        $data['ordernameasc'] = ['sort' => 'name', 'order' => 'asc', 'search' => $search, 'filtertype' => $filtertype];
        $data['ordernamedesc'] = ['sort' => 'name', 'order' => 'desc', 'search' => $search, 'filtertype' => $filtertype];
        $appendData = array_merge($appendData, $sortData);
        $appendData = array_merge($appendData, $searchData);

        $data['appendData'] = $appendData;
        
        $pokemons = $pokemon->orderBy('id', 'asc')->paginate(9)->appends($appendData);
        return view('pokemon.index', ['pokemons' => $pokemons, 'images' => PokemonImage::all(), 'types' => Pokemontype::all()])->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pokemon.create', ['types' => Pokemontype::all(), 'abilities' => Pokemonability::all(), 'regions' => ['Kanto', 'Johto', 'Hoenn', 'Sinnoh', 'Teselia', 'Kalos', 'Alola', 'Galar']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PokemonCreateRequest $request)
    {
        $data = [];
        $data['message'] = 'Un nuevo Pokémon ha sido añadido correctamente';
        $data['type'] = 'success';
        $pokemon = new Pokemon($request->all());
        
        if($pokemon->idprimarytype == $pokemon->idsecondarytype) {
            $data['message'] = 'Un Pokémon no puede tener dos tipos iguales';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        
        try {
            $result = $pokemon->save();
        } catch(\Exception $e) {
            $data['message'] = 'Ya existe un Pokémon con ese nombre';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        if(!$result) {
            $data['message'] = 'El Pokémon no puede ser añadido';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);  
        }

        if($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileUpload = $request->file('photo');
            $nameFile = $fileUpload->getClientOriginalName();
            $nameFile = $pokemon->name . '-' . $nameFile;
            
            $image = new PokemonImage();
            $image->idpokemon = $pokemon->id;
            $image->myname = $nameFile;
            $image->mimetype = $fileUpload->getMimeType();
            
            if($image->mimetype != null) {
                if($image->mimetype != 'image/jpeg' && $image->mimetype != 'image/png'
                    && $image->mimetype != 'image/bmp' && $image->mimetype != 'image/tiff') {
                        $pokemon->delete();
                        $data['message'] = 'Solo se permite la subida de archivos tipo imagen';
                        $data['type'] = 'danger';
                        return back()->withInput()->with($data);
                }
            }
            
            try {
                $resultImg = $image->save();
            } catch(\Exception $e) {
                $resultImg = false;
            }
            if(!$resultImg) {
                $data['message'] = 'El Pokémon no puede ser añadido';
                $data['type'] = 'danger';
                return back()->withInput()->with($data);
            }
            
            $fileUpload->storeAs('public/images/' . $pokemon->id, $nameFile);
        
        } else {
            $pokemon->delete();
            $data['message'] = 'El Pokémon necesita una imagen representativa';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        
        return redirect('pokemon')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemon $pokemon)
    {
        return view('pokemon.show', ['pokemon' => $pokemon, 'images' => PokemonImage::all(), 'abilities' => Pokemonability::all(), 'types' => Pokemontype::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokemon $pokemon)
    {
        return view('pokemon.edit', ['pokemon' => $pokemon, 'types' => Pokemontype::all(), 'images' => PokemonImage::all(), 'abilities' => Pokemonability::all(), 'regions' => ['Kanto', 'Johto', 'Hoenn', 'Sinnoh', 'Teselia', 'Kalos', 'Alola', 'Galar']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function update(PokemonEditRequest $request, Pokemon $pokemon)
    {
        $images = PokemonImage::all();
        foreach($images as $image) {
            if($image->idpokemon == $pokemon->id) {
                $realimg = $image;
            }
        }
        
        if($request->idprimarytype == $request->idsecondarytype) {
            $data['message'] = 'Un Pokémon no puede tener dos tipos iguales';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        
        if($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileUpload = $request->file('photo');
            $nameFile = $fileUpload->getClientOriginalName();
            $nameFile = $pokemon->name . '-' . $nameFile;
            
            if($fileUpload->getMimeType() != null) {
                if($fileUpload->getMimeType() != 'image/jpeg' && $fileUpload->getMimeType() != 'image/png'
                    && $fileUpload->getMimeType() != 'image/bmp' && $fileUpload->getMimeType() != 'image/tiff') {
                        $data['message'] = 'Solo se permite la subida de archivos tipo imagen';
                        $data['type'] = 'danger';
                        return back()->withInput()->with($data);
                }
            }
            
            $args = [
                'myname' => $nameFile,
                'mimetype' => $fileUpload->getMimeType(),
            ];
            
            try {
                $resultImg = $realimg->update($args); ;
            } catch(\Exception $e) {
                $resultImg = false;
            }
            if(!$resultImg) {
                $data['message'] = 'El Pokémon no puede ser editado';
                $data['type'] = 'danger';
                return back()->withInput()->with($data);  
            }
    
            $directory = '/public/images/' . $pokemon->id;
            
            $response = Storage::deleteDirectory($directory);
            
            $fileUpload->storeAs('public/images/' . $pokemon->id, $nameFile);
        
        }
        
        $data = [];
        $data['message'] = 'El Pokémon ' . $pokemon->name . ' se ha actualizado correctamente';
        $data['type'] = 'success';
        
        try {
            $result = $pokemon->update($request->all());  
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El Pokémon no puede ser actualizado';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);  
        }
        
        return redirect('pokemon')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemon $pokemon)
    {
        $data = [];
        $data['message'] = 'El Pokémon ' . $pokemon->name . ' ha sido eliminado';
        $data['type'] = 'success';
        
        $images = PokemonImage::all();
        $id = $pokemon->id;
        
        foreach($images as $image) {
            if($image->idpokemon == $pokemon->id) {
                $image->delete();
                
                $directory = '/public/images/' . $pokemon->id;
                $response = Storage::deleteDirectory($directory);
            }
        }
        
        try {
            $pokemon->delete();
        } catch(\Exception $e) {
            $data['message'] = 'El Pokémon ' . $pokemon->name . ' no ha podido ser eliminado';
            $data['type'] = 'danger';
        }
        return redirect('pokemon')->with($data);
    }
}
