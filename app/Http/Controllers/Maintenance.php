<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Exception;

class Maintenance extends Controller
{
    public function changeUserData(): JsonResponse
    {
        try{

            return response()->json([
                
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Estamos experimentando problemas temporales'
            ], 500);
        }
    }    
}