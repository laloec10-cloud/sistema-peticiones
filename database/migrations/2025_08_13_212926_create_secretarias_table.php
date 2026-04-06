<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('secretarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo', 150);
            $table->string('usuario', 50)->unique();
            $table->string('correo', 100)->unique();
            $table->string('telefono', 15)->nullable();
            $table->text('contraseña');
        });
    }

    public function down(): void {
        Schema::dropIfExists('secretarias');
    }
};
