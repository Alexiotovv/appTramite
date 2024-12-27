<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Template;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Template\Lister;

class TemplateController extends Controller
{
    public function list(Lister $request): JsonResponse
    {
        try{

            
            return response()->json(['items' => , 'total_items' => ], 200);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return $this->defaultResponse($e);
        }
    }
}