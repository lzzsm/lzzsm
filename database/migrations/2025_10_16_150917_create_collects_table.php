<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('collects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cadastrado_id')->constrained('cadastrados')->onDelete('cascade');
        $table->foreignId('collect_point_id')->constrained('collect_points')->onDelete('restrict');
        $table->enum('status', ['agendada', 'realizada', 'cancelada'])->default('agendada');
        $table->dateTime('data');
        $table->dateTime('data_validacao')->nullable();
        $table->integer('pontos_gerados')->unsigned()->default(0);
        $table->text('observacoes')->nullable();
        $table->softDeletes();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collects');
    }
};
