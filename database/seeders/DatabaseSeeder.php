<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MateriaSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ModulosSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PerfilsRolesSeeder::class);
    }
}
