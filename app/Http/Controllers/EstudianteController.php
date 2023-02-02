<?php

namespace App\Http\Controllers;

use App\Models\Persona;

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
        $estudiante = Persona::find($documento);
        if($estudiante->tipo === 'STUDENT') {
            return response()->json($estudiante->materias()->get());
        }
        return response()->json(['message' => "No es un estudiante valido"], 409);
    }
}