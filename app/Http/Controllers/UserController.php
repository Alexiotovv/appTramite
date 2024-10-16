<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{


    public function index(Request $request){
        try {
            $obj=User::all()->select('id','name','email','role','status');
            return response()->json(['status'=>'success','data'=>$obj]);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>$th]);
        }
    }

    public function update(Request $request, $id){
        // return response()->json(['status'=>'success','data'=>$request->all()]);
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email'=> 'required|string|email|max:255',
                'role'=>'required|string',
                'status'=>'required|integer|in:0,1',
            ]);

            $usuario=User::findOrFail($id);
            $usuario->name=$request->input('name');
            $usuario->email=$request->input('email');
            $usuario->role=$request->input('role');
            $usuario->status=$request->input('status');
            $usuario->save();
            return response()->json(['status'=>'success','data'=>'Registro Actualizado']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>'Ocurrió un erro durante la actualización']);
        }

    }

    public function store(Request $request){
        try {
            //Recepcionamos los datos para validar
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email'=> 'required|string|email|max:255|unique:users',
                'password'=>'required|string|min:6',
            ]);

            //Si pasó el validator Creamos el usuario
            $user = User::create([
                'name'=> $request->input('name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
                'role'=>$request->input('role'),
            ]);
            return response()->json(['status'=>'success','message'=>'Registro Guardado','data'=>$user], 200);

        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } catch (\Throwable $th) { //Otros tipos de errores
            return response()->json(['status' => 'error', 'message' => $th], 500);
        }
    }




    public function change_status(Request $request, $user_id)
    {
        try {
            $validated = $request->validate([
                'status_user' => 'required|integer|in:0,1', // Validar que sea entero y esté entre 0 y 1
            ]);
            
            $user = User::findOrFail($user_id);
            $user->status = $validated['status_user'];
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Status cambiado correctamente'], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Error general del servidor
            return response()->json(['status' => 'error', 'message' => 'Error del servidor, por favor revise su solicitud'], 500);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Error inesperado'], 500);
        }

    }

    public function users(Request $request){
        try {
            $users = User::all();
            return response()->json(['usuarios' => $users],200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'server error'],500);
        }
    }

}
