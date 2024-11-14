<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\Office;

class OfficeController extends Controller
{
    public function store(): JsonResponse
    {
        try{
            return response()->json(['message' => 'Estamos experimentando problemas'], 200);
        }catch(Exception $e){
            return $this->defaultResponse($e);
        }
    }

    public function list(): JsonResponse
    {
        try{
            return response()->json(['items' => ''], 200);
        }catch(Exception $e){
            return $this->defaultResponse($e);
        }
    }
    
    public function getReceptionDesk(): JsonResponse
    {
        try{
            $items = Office::receptionDesk();
            return response()->json(['items' => $items], 200);
        }catch(Exception $e){
            return $this->defaultResponse($e);
        }
    }
}