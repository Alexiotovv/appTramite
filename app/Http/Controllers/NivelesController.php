<?php

namespace App\Http\Controllers;

use App\Models\niveles;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\ExceptionHandlerTrait;

class NivelesController extends Controller
{
    use ExceptionHandlerTrait;

    // Listar todos los niveles
    public function index()
    {
        $niveles = niveles::all('id','nombre','descripcion');
        return response()->json(['status' => 'success', 'data' => $niveles], 200);
    }

    // Mostrar un nivel por su ID
    public function show($id)
    {
        return $this->handleExceptions(function () use ($id) {
            $nivel = niveles::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $nivel], 200);
        });
    }

    // Crear un nuevo nivel
    public function store(Request $request)
    {
        return $this->handleExceptions(function () use ($request) {

            $validated = $request->validate([
                'nombre' => 'required|string|max:150|unique:niveles',
                'descripcion' => 'nullable|string|max:150',
            ]);

            $nivel = niveles::create($validated);
            return response()->json(['status' => 'success', 'data' => $nivel], 200);
        });
    }
    // Actualizar un nivel existente
    public function update(Request $request, $id)
    {
        return $this->handleExceptions(function () use ($request, $id) {
            $nivel = niveles::findOrFail($id);
            $validated = $request->validate([
                'nombre' => 'required|string|max:150',
                'descripcion' => 'nullable|string|max:150',
            ]);

            $nivel->update($validated);
            return response()->json(['status' => 'success', 'data' => $nivel, 'message' => 'Registro Actualizado'], 200);
        });
    }

    // Eliminar un nivel
    public function destroy($id)
    {
        try {
            $nivel = niveles::findOrFail($id);
            $nivel->delete();
            return response()->json(['status' => 'success', 'message' => 'Nivel eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Nivel no encontrado'], 404);
        }
    }
    
}
