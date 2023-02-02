<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulos = array(
            // administrador
            array("nombre" => 'Materias', 'url' => '/materias', "icon" => 'fa fa-icon', "short_name" => 'materias_administrador'),
            array("nombre" => 'Usuarios', 'url' => '/usuarios', "icon" => 'fa fa-icon', "short_name" => 'usuarios_administrador'),
            array("nombre" => 'Estudiantes', 'url' => '/estudiantes', "icon" => 'fa fa-icon', "short_name" => 'estudiantes_administrador'),

            // docente   
            array("nombre" => 'Materias', 'url' => '/materias', "icon" => 'fa fa-icon', "short_name" => 'materias_docente'),
            // estudiante
            array("nombre" => 'Materias', 'url' => '/materias', "icon" => 'fa fa-icon', "short_name" => 'materias_estudiantes'),
        );

        DB::table('modulos')->insert($modulos);
    }
}
