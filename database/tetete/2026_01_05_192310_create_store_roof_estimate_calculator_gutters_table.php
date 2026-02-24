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
        Schema::create('store_roof_estimate_calculator_gutters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->text('roof_estimate_calculator_id')->nullable();
            $table->text('recommended_price')->nullable();
            $table->text('gutter_sub_total')->nullable();
            $table->text('gutter_per_sq_price')->nullable();
            $table->text('gutter_sq_total_price')->nullable();
            $table->text('downspouts_sub_total')->nullable();
            $table->text('downspouts_per_sq_price')->nullable();
            $table->text('downspouts_sq_total_price')->nullable();
            $table->text('guards_sub_total')->nullable();
            $table->text('guards_per_sq_price')->nullable();
            $table->text('guards_sq_total_price')->nullable();
            $table->text('miscellaneous')->nullable();
            $table->text('project_cost')->nullable();
            $table->text('margin_profit')->nullable();
            $table->text('super_percentage')->nullable();
            $table->text('super_total')->nullable();
            $table->text('sales_percentage')->nullable();
            $table->text('sales_total')->nullable();
            $table->text('direct_cost')->nullable();
            $table->text('net_profit')->nullable();
            $table->text('margin_percentage')->nullable();
            $table->text('net_profit_percentage')->nullable();
            $table->text('recommended_price_two')->nullable();
            $table->text('gutter_sub_total_two')->nullable();
            $table->text('gutter_per_sq_price_two')->nullable();
            $table->text('gutter_sq_total_price_two')->nullable();
            $table->text('downspouts_sub_total_two')->nullable();
            $table->text('downspouts_per_sq_price_two')->nullable();
            $table->text('downspouts_sq_total_price_two')->nullable();
            $table->text('guards_sub_total_two')->nullable();
            $table->text('guards_per_sq_price_two')->nullable();
            $table->text('guards_sq_total_price_two')->nullable();
            $table->text('miscellaneous_two')->nullable();
            $table->text('project_cost_two')->nullable();
            $table->text('margin_profit_two')->nullable();
            $table->text('super_percentage_two')->nullable();
            $table->text('super_total_two')->nullable();
            $table->text('sales_percentage_two')->nullable();
            $table->text('sales_total_two')->nullable();
            $table->text('direct_cost_two')->nullable();
            $table->text('net_profit_two')->nullable();
            $table->text('margin_percentage_two')->nullable();
            $table->text('net_profit_percentage_two')->nullable();
            $table->text('gutter_miscellaneous')->nullable();
            $table->text('gutter_miscellaneous_two')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_roof_estimate_calculator_gutters');
    }
};
