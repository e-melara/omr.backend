<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'codigo'];

    public function personas()
    {
        return $this->belongsToMany(
            Persona::class,
            'materias_personas',
            'materia_id',
            'persona_id'
        );
    }
}
