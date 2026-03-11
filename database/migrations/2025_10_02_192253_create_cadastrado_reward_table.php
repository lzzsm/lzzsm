<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cadastrado_reward', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cadastrado_id')->constrained('cadastrados')->onDelete('cascade');
            $table->foreignId('reward_id')->constrained('rewards')->onDelete('cascade');
            $table->string('codigo_resgate', 50)->unique();
            $table->integer('pontos_gastos')->unsigned();
            $table->enum('status', ['pendente', 'utilizado', 'reembolsado'])->default('pendente');
            $table->timestamp('data_expiracao');
            $table->timestamp('data_utilizacao')->nullable();
            $table->timestamp('data_reembolso')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['cadastrado_id', 'reward_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cadastrado_reward');
    }
};