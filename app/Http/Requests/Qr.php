<?php

namespace App\Http\Requests;

use App\Http\Requests\Template;

class Qr extends Template
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:256',
        ];
    }
}