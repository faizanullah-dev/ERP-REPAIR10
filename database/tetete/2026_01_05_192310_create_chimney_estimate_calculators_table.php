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
        Schema::create('chimney_estimate_calculators', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('sub_total_bricks_rows')->nullable();
            $table->string('waste_bricks_rows')->nullable();
            $table->string('total_waste_bricks_rows')->nullable();
            $table->string('total_bricks_rows')->nullable();
            $table->string('notes')->nullable();
            $table->string('base_value_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chimney_estimate_calculators');
    }
};
