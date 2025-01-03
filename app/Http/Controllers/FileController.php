<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function templates(Request $request, string $path)
    {
        try{
            if(!Storage::disk('template')->exists($path)){
                return response()->json(['message' => 'Archivo no encontrado'], 404);
            }
            $relativePath = $path;
            $absolutePath = Storage::disk('template')->path($relativePath);
            $fileContent = Storage::disk('template')->get($relativePath);
            $mimeType = Storage::mimeType($absolutePath);
            return response($fileContent, 200)->header('Content-Type', $mimeType);            
        }catch(Exception){
            return $this->defaultResponse();
        }
    }
}