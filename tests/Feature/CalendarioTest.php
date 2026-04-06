<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CalendarioExamen;

class CalendarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_actualizar_examen()
    {
        // Crear registro en la BD
        $examen = CalendarioExamen::create([
            'clave' => '16',
            'modulo' => 'Hacia un desarrollo sustentable',
            'fecha' => '2026-08-22',
            'hora' => '10:00:00',
            'fase' => 'A'
        ]);

        // Actualizar registro
        $examen->update([
            'hora' => '13:30:00',
            'fase' => 'B'
        ]);

        // Verificar en base de datos
        $this->assertDatabaseHas('calendario_examenes', [
            'id' => $examen->id,
            'hora' => '13:30:00',
            'fase' => 'B'
        ]);
    }
}