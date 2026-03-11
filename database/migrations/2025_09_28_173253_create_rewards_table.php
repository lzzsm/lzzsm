<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->string('titulo', 200);
            $table->text('descricao')->nullable();
            $table->integer('pontos_necessarios')->unsigned()->index();
            $table->integer('qtd_disponivel')->unsigned();
            $table->string('img_recompensa')->nullable();
            //$table->boolean('ativo')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};