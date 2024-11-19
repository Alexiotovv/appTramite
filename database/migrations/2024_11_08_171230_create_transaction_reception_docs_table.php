<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Type file:
     * 1: for local
     * 2: Not local
     */
    public function up(): void
    {
        Schema::create('transaction_reception_docs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_reception_id')->constrained('transaction_reception');
            $table->unsignedTinyInteger('type_path');
            $table->string('name_file');
            $table->string('path_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_docs');
    }
};