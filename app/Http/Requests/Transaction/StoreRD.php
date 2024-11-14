<?php

namespace App\Http\Requests\Transaction;

use App\Http\Requests\Template;

/**
 * Validate data for store request desk
*/
class StoreRD extends Template
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doc_main' => [
                'required',
                'mimetypes:application/pdf'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'doc_main.mimetypes' => 'Solo se aceptan archivos pdf en el documento principal',
            
        ];
    }
}