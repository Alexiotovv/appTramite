<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Template;

class Login extends Template
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ];
    }
    
    public function messages(): array
    {
        return [
            'email.required' => 'Correo electrónico requerido',
            'password.required' => 'Contraseña requerida',
            'email.email' => 'Correo electronico no valido',
            'email.exists' => 'No existe este usuario'
        ];
    }   
}