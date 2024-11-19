<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Qr;
use App\Jobs\DeleteFile;
use App\Services\Qr as QrBuilder;

class QrController extends Controller
{
    public function create(Qr $request): JsonResponse
    {
        try{
            $logo = storage_path('app/assets/logo.png');
            $qr =  new QrBuilder($request->code, $logo, 400);
            $qr->configure([
                'size' => $request->size ?? 400,
                'margin' => $request->margin ?? 10,
                'backgroundColor' => [255,255,255],
                'logoPunchoutBackground' => false,
                'roundBlockSizeMode' => 'Margin',
                'blockColor' => [205,49,51]
            ]);

            $path = $qr->make();
            $relativePath = str_replace(storage_path('app/public'), 'disk/uploaded', $path);
            DeleteFile::dispatch($path)->delay(now()->addMinutes(1));
            return response()->json(['uri' => $relativePath], 200);
        }catch(Exception $e){
            return $this->defaultResponse($e);
        }
    }
}