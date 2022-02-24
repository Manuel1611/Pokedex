<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonCreateRequest extends FormRequest
{
    
    public function attributes() {
        return [
            'name' => 'nombre',
            'height' => 'altura',
            'weight' => 'peso',
            'description' => 'descripción',
            'region' => 'región',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages() {
        $required = 'El campo :attribute es obligatorio';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        $unique = 'Ya existe un Pokémon con ese :attribute';
        $gte = 'El campo :attribute debe ser mayor o igual que :value';
        $lte = 'El campo :attribute debe ser menor o igual que :value';
        $numeric = 'El campo :attribute debe ser un número';
        
         return [
             'name.required' => $required,
             'name.min' => $min,
             'name.max' => $max,
             'name.unique' => $unique,
             'height.required' => $required,
             'height.numeric' => $numeric,
             'height.gte' => $gte,
             'height.lte' => $lte,
             'weight.required' => $required,
             'weight.numeric' => $numeric,
             'weight.gte' => $gte,
             'weight.lte' => $lte,
             'description.required' => $required,
             'description.min' => $min,
             'description.max' => $max,
             'region.required' => $required,
         ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:25|unique:pokemon,name',
            'height' => 'required|numeric|gte:0|lte:99999999',
            'weight' => 'required|numeric|gte:0|lte:99999999',
            'description' => 'required|min:2|max:200',
            'region' => 'required',
        ];
    }
}
