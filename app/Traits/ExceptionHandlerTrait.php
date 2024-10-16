<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

trait ExceptionHandlerTrait
{
    public function handleExceptions($callback)
    {
        try {
            return $callback();
        } 
        catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Registro no encontrado'], 404);
        } 
        catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } 
        catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
