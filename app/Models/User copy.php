<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'password',
        'foto_perfil',
        'nick',
        'puntaje',
    ];

    public function forms()
    {
        return $this->hasMany(Form::class, 'usuario_id');
    }

    public function levels()
    {
        return $this->hasMany(Level::class, 'usuario_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswers::class, 'usuario_id');
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class, 'usuario_id');
    }

    public function rankings()
    {
        return $this->hasOne(Ranking::class, 'usuario_id');
    }
}
