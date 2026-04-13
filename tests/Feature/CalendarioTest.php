<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// El nombre de la clase DEBE ser igual al nombre del archivo
class CalendarioTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_ejemplo()
    {
        $this->assertTrue(true);
    }
}
