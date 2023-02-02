<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passwordHash = app('hash')->make("password");
        $usuarios = array(
            array("documento" => '042998540', 'password' => $passwordHash, 'perfil_id' => 1),
            array("documento" => '052106008', 'password' => $passwordHash, 'perfil_id' => 2),
            array("documento" => 'ML012023', 'password' => $passwordHash, 'perfil_id' => 3),
        );

        DB::table('users')->insert($usuarios);
    }
}
