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
        Schema::create('transaction_record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transaction');
            $table->foreignId('user_id_register')->constrained('users');
            $table->foreignId('office_id_origin')->constrained('office');
            $table->foreignId('office_id_end')->nullable()->constrained('office');
            $table->foreignId('user_id_assigned')->nullable()->constrained('users');
            $table->text('subject')->nullable();
            $table->json('observations')->nullable();
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('group_number');
            $table->boolean('is_parallel');
            $table->foreignId('indication_id')->constrained('indication');
            $table->timestamps();
        });

        Schema::table('transaction_record', function(Blueprint $table){
            $table->fullText('subject')->language('spanish');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_record');
    }
};