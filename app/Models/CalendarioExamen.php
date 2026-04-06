<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioExamen extends Model
{
    use HasFactory;

    protected $table = 'calendario_examenes';

    protected $fillable = [
        'clave',
        'modulo',
        'etapa',   
        'fecha',
        'hora',
        'cupo'
    ];

    public $timestamps = false;
}