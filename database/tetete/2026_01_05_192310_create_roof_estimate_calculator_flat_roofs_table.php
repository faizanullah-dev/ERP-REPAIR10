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
        Schema::create('roof_estimate_calculator_flat_roofs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->text('roof_estimate_calculator_id')->nullable();
            $table->text('recommended_price')->nullable();
            $table->text('roofing_price')->nullable();
            $table->text('total_sq')->nullable();
            $table->text('additional_layer')->nullable();
            $table->text('additional_layer_price_per_sq')->nullable();
            $table->text('step_charge')->nullable();
            $table->text('step_charge_price_per_sq')->nullable();
            $table->text('chimney_size')->nullable();
            $table->text('chimney_size_price_per_sq')->nullable();
            $table->text('siding_azeck')->nullable();
            $table->text('siding_azeck_price_per_sq')->nullable();
            $table->text('plywood')->nullable();
            $table->text('plywood_price_per_sq')->nullable();
            $table->text('skylight_price')->nullable();
            $table->text('skylight_price_price_per_sq')->nullable();
            $table->text('materials_price_price_per_sq')->nullable();
            $table->text('materials_price_price_final')->nullable();
            $table->text('labour_price_price_per_sq')->nullable();
            $table->text('labour_price_price_final')->nullable();
            $table->text('dumpster_price_price_per_sq')->nullable();
            $table->text('dumster_price_price_final')->nullable();
            $table->text('permit_warranty_price_price_per_sq')->nullable();
            $table->text('permit_warranty_price_price_final')->nullable();
            $table->text('project_cost')->nullable();
            $table->text('margin_profit')->nullable();
            $table->text('super_percentage')->nullable();
            $table->text('super_price_price_final')->nullable();
            $table->text('sales_percentage')->nullable();
            $table->text('sales_price_price_final')->nullable();
            $table->text('directory_cost')->nullable();
            $table->text('net_profit')->nullable();
            $table->text('margin_percentage')->nullable();
            $table->text('net_profit_percentage')->nullable();
            $table->text('flat_miscellaneous')->nullable();
            $table->text('skylight_labour')->nullable();
            $table->text('skylight_labour_final')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roof_estimate_calculator_flat_roofs');
    }
};
