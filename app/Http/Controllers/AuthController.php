<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Requests\Auth\Login;
use Illuminate\Support\Facades\Log;
use App\Services\Tokens\TokenFactory;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Login $request)
    {
        try{
            $user = User::verifyCredentials($request->email, $request->password);
            if(!is_object($user)){
                switch($user){
                    case 1:
                        $message = 'Usuario inactivo';
                    break;
                    case 2:
                        $message = 'Contraseña incorrecta';
                    break;
                }
                return response()->json([
                    'message' => $message
                ], 401);
            }
            $user->tokens()->delete();
            $tokenOperation = TokenFactory::create('operation');
            $tokenUpdate = TokenFactory::create('update');
            return response()->json([
                'items' => $user,
                'tokenOperation' => $tokenOperation->generate($user),
                'tokenUpdate' => $tokenUpdate->generate($user)
            ], 200);
        }catch(Exception $e){
            Log::error(get_class($this) . 'method : ' .  __FUNCTION__ . ': ' . $e->getMessage());
            return response()->json([
                'message'=>'Estamos experimentando problemas temporales',
                $e->getMessage()
            ], 500);
        }   
    }

    public function refreshTokens(Request $request)
    {
        try{
            $user = $request->user();
            return response()->json([

            ]);
        }catch(Exception $e){
            Log::error(get_class($this) . 'method : ' .  __FUNCTION__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Estamos experimentando problemas'
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'clario'
        ], 200);
    }
}