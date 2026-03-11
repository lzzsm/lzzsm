<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->string('titulo', 200);
            $table->string('subtitulo', 300)->nullable();
            $table->text('conteudo');
            $table->enum('tipo', ['Parceria', 'Evento', 'Comunicado', 'Promoção', 'Informativo'])->default('Informativo')->index();
            $table->string('img_anuncio')->nullable();
            //$table->boolean('ativo')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};