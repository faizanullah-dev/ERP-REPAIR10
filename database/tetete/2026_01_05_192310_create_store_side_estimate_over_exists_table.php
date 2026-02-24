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
        Schema::create('store_side_estimate_over_exists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('side_estimate_calculator_id')->nullable();
            $table->string('recommended_price')->nullable();
            $table->string('price_per_sq_value')->nullable();
            $table->string('siding_sq_value')->nullable();
            $table->string('siding_soffit_value')->nullable();
            $table->string('additional_layer_value')->nullable();
            $table->string('additional_layer_per_sq_value')->nullable();
            $table->string('window_door_value')->nullable();
            $table->string('window_door_per_sq_value')->nullable();
            $table->string('aluminium_trim_value')->nullable();
            $table->string('aluminium_trim_per_sq_value')->nullable();
            $table->string('azeck_wood_value')->nullable();
            $table->string('azeck_wood_per_sq_value')->nullable();
            $table->string('shutter_value')->nullable();
            $table->string('shutter_per_sq_value')->nullable();
            $table->string('plywood_value')->nullable();
            $table->string('plywood_per_sq_value')->nullable();
            $table->string('miselanies')->nullable();
            $table->string('project_cost')->nullable();
            $table->string('material_value')->nullable();
            $table->string('total_material_value')->nullable();
            $table->string('labor_value')->nullable();
            $table->string('total_labor_value')->nullable();
            $table->string('dumpster_value')->nullable();
            $table->string('total_dumpster_value')->nullable();
            $table->string('permit_warranty_value')->nullable();
            $table->string('total_permit_warranty_value')->nullable();
            $table->string('margin_profit_value')->nullable();
            $table->string('super_value')->nullable();
            $table->string('total_super_value')->nullable();
            $table->string('sales_value')->nullable();
            $table->string('total_sales_value')->nullable();
            $table->string('direct_cost_value')->nullable();
            $table->string('net_profit')->nullable();
            $table->string('sub_total_value')->nullable();
            $table->string('total_sub_total_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_side_estimate_over_exists');
    }
};
