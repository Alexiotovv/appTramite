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
        Schema::create('transaction_dispatch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id_origin')->constrained('office');
            $table->string('reception_desk_code');
            $table->string('correlative_code');
            $table->string('organic_unit_code')->nullable();
            $table->string('ruc_entity_end')->nullable();
            $table->string('reception_entity_name')->nullable();
            $table->unsignedTinyInteger('status');
            $table->foreignId('user_id_register')->constrained('users');
            $table->text('subject')->nullable();
            $table->timestamps();
        });

        Schema::table('transaction_dispatch', function(Blueprint $table){
            $table->fullText('subject')->language('spanish');             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_dispatch');
    }
};