<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collect_points', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 200)->index();
            $table->string('rua', 300);
            $table->string('numero', 20)->nullable();
            $table->string('cep', 9);
            $table->string('cidade', 100)->index();
            $table->string('estado', 2)->index();
            //$table->string('bairro', 100)->nullable();
            //$table->string('complemento', 200)->nullable();
            //$table->boolean('ativo')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collect_points');
    }
};