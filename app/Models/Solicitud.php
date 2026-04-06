<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'alumno_id',
        'examen_id',
        'fecha_solicitada',
        'observaciones',
        'estado',
        'fecha_creacion'
    ];

    public $timestamps = false;

    // Relaciones
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function examen()
    {
        return $this->belongsTo(ExamenDisponible::class, 'examen_id');
    }
}
