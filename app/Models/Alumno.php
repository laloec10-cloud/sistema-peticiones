<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'matricula_inca',
        'curp',
        'correo',
        'telefono',
        'contraseña',
    ];

    public $timestamps = false; // si tu tabla no tiene created_at y updated_at
}