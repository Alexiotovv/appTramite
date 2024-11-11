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
        Schema::create('metada_template', function (Blueprint $table) {
            $table->id();
            $table->string('year_name');
            $table->string('path_logo');
            $table->string('address_footer');
            $table->float('margin_top');
            $table->float('margin_bottom');
            $table->float('margin_right');
            $table->float('margin_left');
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