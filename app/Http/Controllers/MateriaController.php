<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Persona;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) :  JsonResponse
    {
        $paginate = Materia::paginate($request->get('per_page'));
        return response()->json( $paginate,  200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $materia = Materia::create([
                "nombre" => $request->input('nombre'),
                "codigo" => $request->input('codigo'),
            ]);        
            DB::commit();
            return response()->json([
                "data"      => $materia,
                "message"   => "Materia creada con exito"
            ],  200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $materia = Materia::where('id', $id)->with('personas')->first();
        return response()->json([
          "data"      => $materia,
      ],  200);
      } catch (\Throwable $th) {
        return response()->json(['message' => $th->getMessage()], 404);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $materia = Materia::find($id);
            $materia->nombre = $request->input('nombre');
            $materia->codigo = $request->input('codigo');
            $materia->save();
            
            DB::commit();
            return response()->json([
                "data" => $materia,
            ],  200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // buscar al alumno por medio de documento, nombres o apellidos
    public function buscarEstudiante(Request $request)
    {
        $this->validate($request, [
            'q' => 'required|string',
        ]);

        $query = $request->get('q');

        $estudiantes = DB::table('users')
            ->join('personas', 'users.documento', '=',  'personas.documento')
            ->Orwhere('personas.documento', 'ilike', '%'.$query.'%')
            ->OrWhere('personas.nombres', 'ilike', '%'.$query.'%')
            ->OrWhere('personas.apellidos', 'ilike', '%'.$query.'%')            
            ->where('users.perfil_id', 3)
            ->select('personas.nombres',  'personas.apellidos', 'personas.documento')
            ->get();

            return response()->json([ "data" => $estudiantes],  200);
    }

    public function agregarEstudiante($id, $estudianteId)
    {
        try {
            DB::beginTransaction();

            $persona = Persona::find($estudianteId);
            if($persona->tipo !== 'STUDENT') {
                return response()->json(['message' => "Debe ser una estudiante valido"], 409);
            }

            $materia = Materia::find($id);
            $materia->personas()->attach($estudianteId, ['activo' => true]);
            DB::commit();
            return response()->json([ "message" => 'Estudiante asignado correctamente'],  200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 409);
        }
    }

    // poder eliminar un alumno de la materia
}
