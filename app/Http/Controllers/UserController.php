<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(): JsonResponse
    {
        try{
            return response()->json(['message' => 'Usuario registrado'], 200);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return $this->defaultResponse($e);
        }     
    }
}