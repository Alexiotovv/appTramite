<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Transaction\StoreRD;
use App\Models\TransactionReception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Concurrency;
use App\Traits\Transaction;

class TransactionController extends Controller
{
    use Transaction;

    public function storeReceptionDesk(StoreRD $request): JsonResponse
    {
        try{
            $officeId = (int) $request->reception_desk_code;
            [$userId, $codeUnique] = Concurrency::run([
                function () use ($officeId) {
                    return $this->selectUserRandom(length: 1, rol: 'reception_desk', office: $officeId);
                },
                function (){
                    do{
                        $codeUnique = transactionCode('JYC');
                        $exists =TransactionReception::where('public_unit_code', $codeUnique)->exists();
                    } while($exists == true);
                    return $codeUnique;
                }
            ]);

        
            DB::transaction(function() use ($request){
                
            });

            return response()->json(['message' => ''], 201);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return $this->defaultResponse($e);
        }
    }
}