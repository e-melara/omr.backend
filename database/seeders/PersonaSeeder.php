<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::create([
            "nombres" => "Edwin",
            "apellidos" => "Melara Landaverde",
            "documento" => '042998540'
        ]);

        Persona::create([
            "nombres" => "Erika del Rosario",
            "apellidos" => "Ventura Rafael",
            "documento" => '052106008'
        ]);

        Persona::create([
            "nombres" => "Edwin",
            "apellidos" => "Melara Landaverde",
            "documento" => 'ML012023'
        ]);
    }
}
