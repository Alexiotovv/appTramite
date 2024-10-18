<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tipodocumentos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_documento', 100)->nullable();
            $table->string('nombre_documento', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipodocumentos');
    }
};
