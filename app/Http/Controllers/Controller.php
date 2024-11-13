<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Exception;

abstract class Controller
{
    public function LogError(string $class, Exception $e,  string $function)
    {   
        Log::error($class . ', '.  $function . ':' . $e->getMessage());
    }

    public function defaultResponse(?Exception $e): JsonResponse
    {
        return response()->json([
            'message' => 'Estamos experimentando problemas temporales',
            $e->getMessage()
        ]);
    }
}