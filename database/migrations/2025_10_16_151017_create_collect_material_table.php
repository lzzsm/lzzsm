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
    Schema::create('collect_material', function (Blueprint $table) {
        $table->id();
        $table->foreignId('collect_id')->constrained('collects')->onDelete('cascade');
        $table->foreignId('material_id')->constrained('materials')->onDelete('restrict');
        $table->decimal('peso', 8, 2);
        $table->integer('pontos_calculados')->unsigned()->default(0);
        $table->softDeletes();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collect_material');
    }
};
