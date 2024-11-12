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
        Schema::create('transaction_reception', function (Blueprint $table) {
            $table->id();
            $table->string('ruc_entity')->nullable();
            $table->enum('type_doc_register', ['carnet', 'dni', 'ruc'])->nullable();
            $table->string('number_doc')->nullable();
            $table->string('reception_desk_code');
            $table->string('organic_unit_code');
            $table->string('subject')->nullable();
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('type_origin');
            $table->string('code_public_entity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_reception');
    }
};
