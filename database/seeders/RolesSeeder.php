<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO: Pendiente los usuarios y las notas
        $roles = array(
            // administrador
            array("nombre" => "ROL_ADMINISTRADOR_LIST_MATERIAS", "modulo_id" => 1),
            array("nombre" => "ROL_ADMINISTRADOR_ADD_MATERIAS", "modulo_id" => 1),
            array("nombre" => "ROL_ADMINISTRADOR_UPDATE_MATERIAS", "modulo_id" => 1),
            array("nombre" => "ROL_ADMINISTRADOR_MATERIA_ESTUDIANTE_LIST", "modulo_id" => 1),

            array("nombre" => "ROL_ADMINISTRADOR_ESTUDIANTE_LIST", "modulo_id" => 3),
            array("nombre" => "ROL_ADMINISTRADOR_ESTUDIANTE_ADD", "modulo_id" => 3),
            array("nombre" => "ROL_ADMINISTRADOR_ESTUDIANTE_UPDATE", "modulo_id" => 3),
            array("nombre" => "ROL_ADMINISTRADOR_ESTUDIANTE_SEARCH", "modulo_id" => 3),

            array("nombre" => "ROL_DOCENTE_MATERIA_LIST", "modulo_id" => 4),
            array("nombre" => "ROL_DOCENTE_MATERIA_ESTUDIANTE_LIST", "modulo_id" => 4),

            array("nombre" => "ROL_ESTUDIANTE_MATERIA_LIST", "modulo_id" => 5),
        );

        DB::table('rols')->insert($roles);
    }
}
