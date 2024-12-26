<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\COntracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Services\CheckPermission;

class Template extends FormRequest
{
    public $permissions;

    public function setPermission(array $permissions): void 
    {  
        $this->permissions = $permissions;
    }

    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = request()->user();
        $check =  new CheckPermission($user->id);
        if($check->check(['manage_templates'])){
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
