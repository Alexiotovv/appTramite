<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Transaction\StoreRD;

class TransactionController extends Controller
{
    public function storeReceptionDesk(StoreRD $request): JsonResponse
    {
        try{
            
            return response()->json(['message' => ''], 201);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return $this->defaultResponse($e);
        }
    }
}