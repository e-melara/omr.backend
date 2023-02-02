<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'nombres' => 'required|string',
            'apellidos' => 'required',
            'documento' => 'required|unique:users',
            'password' => 'required|string',
            'type'     => 'required|in:STUDENT,DOCENTE',
        ]);

        DB::beginTransaction();
        try {
            $persona = Persona::create([
                'nombres' => $request->get('nombres'),
                'apellidos' => $request->get('apellidos'),
                'documento' => $request->get('documento')
            ]);

            $usuario = User::create([
                "password" =>  app('hash')->make($request->get('password')),
                "documento" => $request->get('documento'),
                "perfil_id" => $request->type === 'STUDENT' ? 3 : 2,
            ]);
            $persona->usuario()->associate($usuario);

            DB::commit();
            return response()->json([
                "user" => $persona,
                "message" => "Usuario creado con exito",
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 409);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'documento' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['documento', 'password']);
        $token = Auth::setTTL(7200)->attempt($credentials);
        if (!$token) {
            return response()->json(['message' => 'El usuario o contraseña no es la correcta'], 401);
        }

        $user = Auth::user();
        return response()->json([
            "token"         => $token,
            'username'      => $user->documento,
            'full_name'      => $user->persona->nombres . ' ' . $user->persona->apellidos,
            "expires_in"    => Auth::factory()->getTTL()
        ],  200);
    }

    public function logout()
    {
        try {
            auth()->logout(true);
            return response()->json([
                'status'    => 'success',
                'message'   => 'Usuario logged con exito'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage()
            ]);
        }
    }
}
