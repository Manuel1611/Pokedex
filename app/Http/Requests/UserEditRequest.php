<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    
    public function attributes() {
        return [
            'name' => 'nombre',
            'email' => 'correo',
            'rol' => 'rango',
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
        $email = 'El :attribute ha de ser un correo electrónico válido';
        $unique = 'El :attribute ya está en uso';
        
         return [
             'name.required' => $required,
             'name.min' => $min,
             'name.max' => $max,
             'email.required' => $required,
             'email.email' => $email,
             'email.min' => $min,
             'email.max' => $max,
             'email.unique' => $unique,
             'rol.required' => $required,
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
            'name' => 'required|min:2|max:15',
            'email' => 'required|email|min:5|max:40|unique:users,email,' . $this->user->id,
            'rol' => 'required',
        ];
    }
}
