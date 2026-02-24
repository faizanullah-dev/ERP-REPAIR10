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
        Schema::create('roof_estimate_calculator_flat_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('section')->nullable();
            $table->string('eave')->nullable();
            $table->string('rakes')->nullable();
            $table->string('calculate_final_value_flat_area')->nullable();
            $table->string('roof_estimate_calculator_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roof_estimate_calculator_flat_areas');
    }
};
