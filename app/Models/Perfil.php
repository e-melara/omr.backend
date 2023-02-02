<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(
            Rol::class,
            'perfils_rols',
            'perfil_id',
            'rol_id'
        );
    }
}
