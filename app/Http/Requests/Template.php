<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\COntracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class Template extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    { 
        $jsonResponse  = new JsonResponse([
            'message' => messageValidation($validator)
        ], 422);
        
        throw new HttpResponseException($jsonResponse);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }
}
