<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
            $table->foreignId('examen_id')->constrained('examenes_disponibles')->onDelete('cascade');
            $table->date('fecha_solicitada');
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['Pendiente', 'Aprobada', 'Rechazada'])->default('Pendiente');
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('solicitudes');
    }
};
