<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'nombres' => 'required|string',
            'apellidos' => 'required',
            'usuario' => 'required|unique:users',
            'password' => 'required|string',
        ]);

        try {
            $data = User::create([
                'nombres' => $request->get('nombres'),
                'apellidos' => $request->get('apellidos'),
                'usuario' => $request->get('usuario'),
                'password' => app('hash')->make($request->get('password'))
            ]);
            return response()->json([
                "user" => $data,
                "message" => "Usuario creado con exito",
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 409);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['usuario','password']);
        $token = Auth::setTTL(7200)->attempt($credentials);
        if(!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        return response()->json([
            "token"         => $token,
            'username'      => $user->usuario0,
            'full_name'      => $user->nombres. ' ' . $user->apellidos,
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