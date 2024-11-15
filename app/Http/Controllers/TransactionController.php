<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Transaction\StoreRD;
use App\Models\User;
use App\Models\TransactionReception;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function storeReceptionDesk(StoreRD $request): JsonResponse
    {
        try{
            do{
                $codeUnique = transactionCode('JYC');
                $exists =TransactionReception::where('public_unit_code', $codeUnique)->exists();
            }while($exists == true);
            DB::transaction(function() use ($request){
            });

            return response()->json(['message' => ''], 201);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return $this->defaultResponse($e);
        }
    }
}