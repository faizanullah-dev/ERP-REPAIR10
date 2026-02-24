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
        Schema::create('roof_estimate_calculators', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('eave_rakes_sub_total')->nullable();
            $table->string('eave_rakes_waste')->nullable();
            $table->string('eave_rakes_total_waste')->nullable();
            $table->string('eave_rakes_total')->nullable();
            $table->string('eave_rakes_total_percent')->nullable();
            $table->string('eave_rakes_flat_area_sub_total')->nullable();
            $table->string('eave_rakes_flat_area_waste')->nullable();
            $table->string('eave_rakes_total_flat_area_waste')->nullable();
            $table->string('eave_rakes_flat_area_total')->nullable();
            $table->string('gutter_sub_total')->nullable();
            $table->string('downspout_sub_total')->nullable();
            $table->string('guards_sub_total')->nullable();
            $table->string('total_all_downspouts')->nullable();
            $table->longText('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roof_estimate_calculators');
    }
};
