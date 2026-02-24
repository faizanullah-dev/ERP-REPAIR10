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
        Schema::create('store_chimney_estimate_calculator_chimneys', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('chimney_estimate_calculator_id')->nullable();
            $table->string('recommended_price')->nullable();
            $table->string('chimney_price')->nullable();
            $table->string('bricks')->nullable();
            $table->string('stories')->nullable();
            $table->string('total_stories_value')->nullable();
            $table->string('pitch')->nullable();
            $table->string('total_pitch_value')->nullable();
            $table->string('dificultie')->nullable();
            $table->string('total_dificultie_value')->nullable();
            $table->string('chimney_cap')->nullable();
            $table->string('total_chimney_cap_value')->nullable();
            $table->string('material')->nullable();
            $table->string('total_material_value')->nullable();
            $table->string('labor')->nullable();
            $table->string('total_labor_value')->nullable();
            $table->string('dumpster')->nullable();
            $table->string('total_dumpster_value')->nullable();
            $table->string('permit_warranty')->nullable();
            $table->string('total_permit_warranty_value')->nullable();
            $table->string('project_cost')->nullable();
            $table->string('margin_profit')->nullable();
            $table->string('sales')->nullable();
            $table->string('total_sales_value')->nullable();
            $table->string('direct_cost')->nullable();
            $table->string('net_profit')->nullable();
            $table->string('margin_percent')->nullable();
            $table->string('net_profit_percent')->nullable();
            $table->string('miscellaneous')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_chimney_estimate_calculator_chimneys');
    }
};
