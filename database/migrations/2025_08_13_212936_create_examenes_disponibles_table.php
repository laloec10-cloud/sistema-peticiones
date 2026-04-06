<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('examenes_disponibles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_examen', 150);
            $table->text('descripcion')->nullable();
            $table->integer('duracion_minutos')->nullable();
            $table->date('fecha_disponible');
        });
    }

    public function down(): void {
        Schema::dropIfExists('examenes_disponibles');
    }
};
