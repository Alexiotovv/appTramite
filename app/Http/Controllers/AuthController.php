<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\Models\User;
use std\Class;
use Iluminate\Support\Facades\Hash;


class AuthController extends Controller
{
    

    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Obtener el usuario autenticado

            // Generar un token personal usando Sanctum
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'data' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function logout(Request $request)
    {
        // Revocar el token actual de la solicitud
        $request->user()->currentAccessToken()->delete();
    
        return response()->json(['data' => 'success', 'message' => 'Successfully logged out']);
    }

    
    
    
}
