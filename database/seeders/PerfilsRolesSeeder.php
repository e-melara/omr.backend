<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles_roles = array(
            // administrador
            array("perfil_id" => 1, "rol_id" => 1),
            array("perfil_id" => 1, "rol_id" => 2),
            array("perfil_id" => 1, "rol_id" => 3),
            array("perfil_id" => 1, "rol_id" => 4),
            array("perfil_id" => 1, "rol_id" => 5),
            array("perfil_id" => 1, "rol_id" => 6),
            array("perfil_id" => 1, "rol_id" => 7),
            array("perfil_id" => 1, "rol_id" => 8),

            // docente
            array("perfil_id" => 2, "rol_id" => 9),
            array("perfil_id" => 2, "rol_id" => 10),

            // estudiante
            array("perfil_id" => 3, "rol_id" => 11)
        );

        DB::table('perfils_rols')->insert($perfiles_roles);
    }
}
