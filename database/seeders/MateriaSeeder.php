<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materias = [
            ["nombre" => 'Matematica', "codigo" => "MAT01"],
            ["nombre" => 'Estudio Sociales', "codigo" => "EST01"],
            ["nombre" => 'Lenguaje y Literatura', "codigo" => "LEN01"],
            ["nombre" => 'Ciencias Sociales', "codigo" => "CIST01"],
            ["nombre" => 'Ciencias Naturales', "codigo" => "CIN01"],
        ];

        DB::table('materias')->insert($materias);
    }
}
