<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cadastrados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            $table->string('cpf', 11)->unique();
            $table->integer('pontuacao_total')->unsigned()->default(0);
            $table->integer('pontuacao_gasta')->unsigned()->default(0);
            $table->integer('coletas_realizadas')->unsigned()->default(0);
            //$table->string('telefone', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cadastrados');
    }
};