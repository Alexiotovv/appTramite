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
        Schema::create('metadata_template', function (Blueprint $table) {
            $table->id();
            $table->string('path_template');
            $table->string('year_name');
            $table->string('path_logo_entity');
            $table->string('path_logo_digital_government');
            $table->smallInteger('type_doc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metada_template');
    }
};