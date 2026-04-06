<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;

    protected $table = 'secretarias';

    protected $fillable = [
        'nombre_completo',
        'usuario',
        'correo',
        'telefono',
        'contraseña'
    ];

    public $timestamps = false;
}
