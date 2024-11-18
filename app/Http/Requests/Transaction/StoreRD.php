<?php

namespace App\Http\Requests\Transaction;

use App\Http\Requests\Template;
use App\Rules\VerifyFormDataFiles;
use Illuminate\Validation\Rule;
/**
 * Validate data for store request desk
*/
class StoreRD extends Template
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'reception_desk_code' => base64_decode($this->reception_desk_code)
        ]);
    }
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
            'number_doc_register' => 'required|string|max:255',
            'reception_desk_code' => [
                'required',
                'string', 
                'max:255', 
                Rule::exists('office', 'id')
            ],
            'doc_main' => [
                'required',
                'max:20480',
                'mimetypes:application/pdf'
            ],
            'doc_anexos' => [
                'nullable',
                new VerifyFormDataFiles('receptionDesk')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_number_doc_remitente.required' => 'Número de trámite documentario requerido',
            'reception_desk_code.exists' => 'Tío, que estas haciendo esto no va de eso',
            'date_doc_remitente.required' => 'Fecha de documento de trámite requerido',
            'organic_unit_destino.required' => 'Código de unidad orgánica requerido',
            'subject.required' => 'Asunto requerido',
            'type_doc_register.required' => 'Tipo de documento de solicitante requerido',
            'number_doc_register.required' => 'Número de documento de solicitante requerido',
            'doc_main.mimetypes' => 'Solo se aceptan archivos pdf en el documento principal',
            'doc_main.max' => 'El archivo no debe superar los 20MB'
        ];
    }
}