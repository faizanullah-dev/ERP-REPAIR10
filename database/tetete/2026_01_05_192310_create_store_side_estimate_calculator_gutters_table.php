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
        Schema::create('store_side_estimate_calculator_gutters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('siding_estimate_calculator_id')->nullable();
            $table->string('recommended_price')->nullable();
            $table->string('gutter_sub_total')->nullable();
            $table->string('gutter_per_sq_price')->nullable();
            $table->string('gutter_sq_total_price')->nullable();
            $table->string('downspouts_sub_total')->nullable();
            $table->string('downspouts_per_sq_price')->nullable();
            $table->string('downspouts_sq_total_price')->nullable();
            $table->string('guards_sub_total')->nullable();
            $table->string('guards_per_sq_price')->nullable();
            $table->string('guards_sq_total_price')->nullable();
            $table->string('project_cost')->nullable();
            $table->string('margin_profit')->nullable();
            $table->string('super_percentage_two')->nullable();
            $table->string('super_percentage')->nullable();
            $table->string('super_total')->nullable();
            $table->string('sales_percentage')->nullable();
            $table->string('sales_total')->nullable();
            $table->string('direct_cost')->nullable();
            $table->string('net_profit')->nullable();
            $table->string('margin_percentage')->nullable();
            $table->string('net_profit_percentage')->nullable();
            $table->string('recommended_price_two')->nullable();
            $table->string('gutter_sub_total_two')->nullable();
            $table->string('gutter_per_sq_price_two')->nullable();
            $table->string('gutter_sq_total_price_two')->nullable();
            $table->string('downspouts_sub_total_two')->nullable();
            $table->string('downspouts_sq_total_price_two')->nullable();
            $table->string('guards_sub_total_two')->nullable();
            $table->string('guards_per_sq_price_two')->nullable();
            $table->string('guards_sq_total_price_two')->nullable();
            $table->string('margin_profit_two')->nullable();
            $table->string('project_cost_two')->nullable();
            $table->string('super_total_two')->nullable();
            $table->string('sales_percentage_two')->nullable();
            $table->string('downspouts_per_sq_price_two')->nullable();
            $table->string('direct_cost_two')->nullable();
            $table->string('net_profit_two')->nullable();
            $table->string('margin_percentage_two')->nullable();
            $table->string('sales_total_two')->nullable();
            $table->string('net_profit_percentage_two')->nullable();
            $table->string('miscellaneous_one')->nullable();
            $table->string('miscellaneous_two')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_side_estimate_calculator_gutters');
    }
};
