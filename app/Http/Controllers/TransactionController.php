<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Transaction\StoreRD;
use App\Models\TransactionReception;
use App\Models\TransactionReceptionDocs;
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
                fn() => $this->selectUserRandom(length: 1, rol: 'reception_desk', office: $officeId),
                function() {
                    do {
                        $codeUnique = transactionCode('JYC');
                    } while (TransactionReception::where('public_unit_code', $codeUnique)->exists());
                    return $codeUnique;
                }
            ]);
        
            DB::transaction(function() use ($request, $userId, $codeUnique, &$transactionId, &$docs) {
                $transactionId = TransactionReception::storeReception(
                    $request->ruc_entity_remitente,
                    $request->name_entity_remitente,
                    $request->organic_unit_sender,
                    $request->cod_reference,
                    $request->transaction_number_doc_remitente,
                    $request->date_doc_remitente,
                    $request->organic_unit_destino,
                    $request->name_destinatario,
                    $request->job_title_destinatario,
                    $request->subject,
                    $request->type_doc_register,
                    $request->number_doc_register,
                    1,
                    $userId,
                    $request->reception_desk_code,
                    $codeUnique
                );

                $partialPath = date('Y/m/d');
                $docs = collect();

                if ($request->hasFile('doc_main')) {
                    $mainFile = $request->file('doc_main');
                    $docs->push([
                        'name' => $request->transaction_number_doc_remitente,
                        'path' => $mainFile->store("app/public/$partialPath")
                    ]);
                }

                if ($request->doc_anexos) {
                    foreach ($request->doc_anexos as $item) {
                        $docs->push([
                            'name' => $item['name'],
                            'path' => $item['file']->store("app/public/$partialPath")
                        ]);
                    }
                }
            });
            $functions = $docs->map(function ($doc) use ($transactionId) {
                return function () use ($transactionId, $doc) {
                    TransactionReceptionDocs::storeDocs($transactionId, $doc['name'], $doc['path']);
                };
            })->toArray();
            Concurrency::run($functions);

            return response()->json([
                'message' => 'Documento registrado con éxito. Para realizar el seguimiento de su trámite, utilice el código :' . $codeUnique . " en nuestro módulo de seguimiento.",
                'code' => $codeUnique
            ], 201);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return $this->defaultResponse($e);
        }
    }
}