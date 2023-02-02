<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = array(
            array('nombre' => "Administrador"),
            array('nombre' => "Docente"),
            array('nombre' => "Estudiante"),
        );

        DB::table('perfils')->insert($perfiles);
    }
}
