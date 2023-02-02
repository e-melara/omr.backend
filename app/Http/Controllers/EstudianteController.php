<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $documento
     * @return \Illuminate\Http\Response
     */
    public function show($documento)
    {
        $estudiante = Persona::where('documento',  $documento)->first();
        if ($estudiante) {
            $materias = $estudiante->materias;
            return response()->json([
                "estudiante"    => $estudiante,
            ]);
        }
        return response()->json(['message' => "No es un estudiante valido"], 409);
    }

    public function index(Request $request)
    {
        $estudiantes = DB::table('users')
            ->where('perfil_id', 3)
            ->join('personas', 'users.documento', '=',  'personas.documento')
            ->select('personas.nombres',  'personas.apellidos', 'personas.documento')
            ->get();

        return response()->json([
            "estudiante"    => $estudiantes,
        ]);
    }
}
