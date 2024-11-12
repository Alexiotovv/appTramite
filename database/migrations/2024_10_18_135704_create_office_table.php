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
        Schema::create('office', function (Blueprint $table) {
            $table->id();
            $table->string('init', 50)->nullable();
            $table->string('name', 150)->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedTinyInteger('level');
            $table->foreignId('group')->nullable()->constrained('office');
            $table->boolean('is_reception_desk')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};