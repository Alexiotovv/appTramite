<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150)->nullable()->default('');
            $table->string('descripcion', 150)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niveles');
    }
};
