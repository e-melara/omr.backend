<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'password', 'documento', 'perfil_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        $perfil = $this->perfil;
        $roles = array();
        $idsRoles = array();
        foreach ($perfil->roles as $value) {
            array_push($roles, $value->nombre);
            if(!in_array($value->modulo_id, $idsRoles)) {
                array_push($idsRoles, $value->modulo_id);
            }
        }

        $modulos = Modulo::whereIn("id", $idsRoles)->select('short_name')->get();

        return [
            "id"        => $this->id,
            "roles"     => $roles,
            "perfil"    => $perfil->nombre,
            "modulos"   => $modulos
        ];
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,  'documento');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class,  'perfil_id');
    }
}
