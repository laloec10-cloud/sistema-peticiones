<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudExamen extends Model
{
    protected $table = 'solicitudes_examen';

    protected $fillable = [
        'alumno_id',
        'calendario_id',
        'fecha',
        'hora'
    ];

    // 🔗 Relación con el calendario de exámenes
    public function calendario()
    {
        return $this->belongsTo(CalendarioExamen::class, 'calendario_id');
    }
}
