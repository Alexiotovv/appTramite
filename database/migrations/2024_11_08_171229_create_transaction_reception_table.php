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
            $table->string('ruc_entity_sender')->nullable();
            $table->string('name_entity_sender')->nullable();
            $table->string('organic_unit_sender')->nullable();
            $table->string('cod_reference')->nullable();
            $table->string('transaction_number_doc_sender');
            $table->date('date_doc_sender');
            $table->string('organic_unit_end'); 
            $table->string('name_addressee')->nullable(); 
            $table->string('job_title_addressee')->nullable();
            $table->string('subject', 500);
            $table->enum('type_doc_register', ['carnet', 'dni', 'ruc']);
            $table->string('number_doc_register')->nullable();
            $table->unsignedTinyInteger('status');
            $table->foreignId('user_id_assign')->constrained('users');
            $table->foreignId('office_id')->constrained('office');
            $table->string('public_unit_code')->unique();
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