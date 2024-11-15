<?php

namespace App\Http\Requests\Transaction;

use App\Http\Requests\Template;
use App\Rules\VerifyFormDataFiles;

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
            'ruc_entity_remitente' => 'nullable|integer|max:255',
            'name_entity_remitente' => 'nullable|string|max:255',
            'organic_unit_sender' => 'nullable|string|max:255',
            'cod_reference' => 'nullable|string|max:255',
            'transaction_number_doc_remitente' => 'required|string|max:255',
            'date_doc_remitente' => 'required|date',
            'organic_unit_destino' => 'required|string|max:255',
            'name_destinatario' => 'nullable|string|max:255',
            'job_title_destinatario' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'type_doc_register' => 'required|in:carnet,dni,ruc',
            'ruc'
            'doc_main' => [
                'required',
                'mimetypes:application/pdf',
                new VerifyFormDataFiles('receptionDesk')
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