<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FechasFiltradasFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function la_ruta_fechas_filtradas_devuelve_json_correctamente()
    {
        // 1️⃣ Crear datos de prueba en la base de datos
        \DB::table('calendario_examenes')->insert([
            'clave' => 'MATH101',
            'modulo' => 'Matemáticas I',
            'fecha' => '2026-04-10',
            'hora' => '10:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2️⃣ Llamar a la ruta incluyendo {etapa}
        $response = $this->getJson('/alumno/fechas-filtradas/MATH101/1');

        // 3️⃣ Verificaciones
        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonFragment(['clave' => 'MATH101']);
    }
}