<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'nombres' => 'required|string',
            'apellidos' => 'required',
            'usuario' => 'required|unique:users',
            'password' => 'required',
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
}