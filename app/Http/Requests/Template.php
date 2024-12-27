<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Services\CheckPermission;
use Exception;

class Template extends FormRequest
{
    public string $permissions;

    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        $user = request()->user();
        if(empty($user)){
            throw new Exception('Usuario no encontrado');
        }
        $check =  new CheckPermission($user->id);
        if(empty($this->permissions)){
            throw new Exception('Permisos no declarados');
        }
        if($check->check($this->permissions)){
            return true;
        }
        return false;
    }

    protected function failedValidation(Validator $validator)
    { 
        $jsonResponse  = new JsonResponse([
            'message' => messageValidation($validator)
        ], 422);
        
        throw new HttpResponseException($jsonResponse);
    }

    public function rules(): array
    {
        return [];
    }
}
