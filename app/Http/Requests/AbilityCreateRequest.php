<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbilityCreateRequest extends FormRequest
{
    
    public function attributes() {
        return [
            'name' => 'nombre',
            'battleeffect' => 'efecto en combate',
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
        $unique = 'Ya existe una habilidad con ese :attribute';
        
         return [
             'name.required' => $required,
             'name.min' => $min,
             'name.max' => $max,
             'name.unique' => $unique,
             'battleeffect.required' => $required,
             'battleeffect.min' => $min,
             'battleeffect.max' => $max,
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
            'name' => 'required|min:2|max:15|unique:pokemonability,name',
            'battleeffect' => 'required|min:2|max:200',
        ];
    }
}
