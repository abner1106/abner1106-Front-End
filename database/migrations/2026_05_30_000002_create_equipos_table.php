<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('id_equipo');
            $table->string('tipo_equipo');
            $table->string('num_serie')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->text('caracteristicas');
            $table->string('estado');
            $table->unsignedBigInteger('ubicacion_id');
            $table->timestamps();

            $table->foreign('ubicacion_id')
                ->references('id_ubicacion')
                ->on('ubicaciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
