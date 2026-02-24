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
        Schema::create('calculator_base_values', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->binary('roof')->nullable();
            $table->binary('siding')->nullable();
            $table->binary('chimney')->nullable();
            $table->binary('salary_block')->nullable();
            $table->longText('roof_margin_profit')->nullable();
            $table->longText('siding_margin_profit')->nullable();
            $table->longText('chimney_chimney')->nullable();
            $table->longText('chimney_liner')->nullable();
            $table->longText('chimney_margin_profit')->nullable();
            $table->longText('roof_prefer')->nullable();
            $table->longText('roof_system')->nullable();
            $table->longText('roof_under_sq')->nullable();
            $table->longText('roof_gutter')->nullable();
            $table->longText('roof_flat_roof')->nullable();
            $table->longText('siding_replacement')->nullable();
            $table->longText('siding_over_existing')->nullable();
            $table->longText('siding_gutter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculator_base_values');
    }
};
