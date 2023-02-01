<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombres', 'apellidos', 'tipo', 'documento'];
    public $incrementing = false;
    protected $primaryKey = 'documento';

    public function usuario()
    {
        return $this->hasOne(User::class,  'documento');
    }

    public function materias()
    {
        return $this->belongsToMany(
            Materia::class,
            'materias_personas',
            'persona_id',
            'materia_id',
        );
    }
}
