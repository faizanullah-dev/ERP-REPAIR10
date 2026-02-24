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
        Schema::create('siding_estimate_calculator_eave_rakes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('siding_estimate_calculator_id')->nullable();
            $table->string('section')->nullable();
            $table->string('eave')->nullable();
            $table->string('rakes')->nullable();
            $table->string('eave_final_rakes')->nullable();
            $table->string('eave_final_rakes_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siding_estimate_calculator_eave_rakes');
    }
};
