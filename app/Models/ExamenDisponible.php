<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenDisponible extends Model
{
    use HasFactory;

    protected $table = 'examenes_disponibles';

    protected $fillable = [
        'nombre_examen',
        'descripcion',
        'duracion_minutos',
        'fecha_disponible'
    ];

    public $timestamps = false;

    // Relación con solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'examen_id');
    }
}
