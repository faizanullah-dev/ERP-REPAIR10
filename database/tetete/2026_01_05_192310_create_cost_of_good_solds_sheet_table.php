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
        Schema::create('cost_of_good_solds_sheet', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('cost_of_good_sold_id')->nullable();
            $table->string('cogs_material_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('unit_qty')->nullable();
            $table->string('qty_price')->nullable();
            $table->string('job_per_hr')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('user_id')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('job_per_hr_is_checked')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_of_good_solds_sheet');
    }
};
