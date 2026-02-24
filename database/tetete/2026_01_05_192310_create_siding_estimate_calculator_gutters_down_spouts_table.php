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
        Schema::create('siding_estimate_calculator_gutters_down_spouts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('siding_estimate_calculator_id')->nullable();
            $table->string('section')->nullable();
            $table->string('gutters')->nullable();
            $table->string('guards')->nullable();
            $table->string('downspouts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siding_estimate_calculator_gutters_down_spouts');
    }
};
