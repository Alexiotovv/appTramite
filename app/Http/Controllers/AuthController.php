<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Requests\Auth\Login;
use App\Services\Tokens\TokenFactory;
use App\Services\Tokens\TokenService;
use App\Exceptions\Services\Tokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Concurrency;
use App\Events\Login AS LoginE;
use App\Events\Logout;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function login(Login $request)
    {
        try{
            $email = $request->email;
            $password = $request->password;
            [$user, $metadaUser] = Concurrency::run([
                fn() => User::verifyCredentials($email, $password),
                fn() => User::retriveUserFill($email)
            ]);

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
            LoginE::dispatch($metadaUser);
            $tokenOperation = TokenFactory::create('operation');
            $tokenUpdate = TokenFactory::create('update');
            return response()->json([
                'items' => $metadaUser,
                'tokenOperation' => $tokenOperation->generate($user),
                'tokenUpdate' => $tokenUpdate->generate($user)
            ], 200);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
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
            list($tokenOperation, $tokenUpdate) = TokenService::refreshTokens($user);
            return response()->json([
                'tokenOperation' => $tokenOperation,
                'tokenUpdate' => $tokenUpdate
            ], 200);
        }catch(Tokens $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return response()->json([
                'message' => 'Estamos experimentando problemas'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try{
            $user = $request->user();
            $user->tokens()->delete();
            Logout::dispatch($user->id);
            return response()->json([
                'message' => 'clario'
            ], 200);
        }catch(Exception $e){
            $this->LogError(get_class($this), $e, __FUNCTION__);
            return response()->json([
                'message' => 'Estamos experimentando problemas temporales'
            ], 500);
        }
    }

    public function retrive(int $id)
    {
        return Cache::get($id, 'no hay');
    }
}