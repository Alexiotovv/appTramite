<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('correlative_jump', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained('office');
            $table->foreignId('type_doc_id')->constrained('type_doc');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedInteger('correlative');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correlative_jump');
    }
};
