<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * O sea el tramite ps 
     */
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id_register')->constrained('office');
            $table->foreignId('type_doc')->constrained('type_doc');
            $table->foreignId('user_id_register')->constrained('users');
            $table->string('number_record')->unique();
            $table->string('code_public');
            $table->boolean('is_public')->default(0);
            $table->boolean('is_multiple')->default(0);
            $table->unsignedTinyInteger('status');
            $table->foreignId('transaction_reception_id')->nullable()->constrained('transaction_reception');
            $table->unsignedTinyInteger('type_origin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
