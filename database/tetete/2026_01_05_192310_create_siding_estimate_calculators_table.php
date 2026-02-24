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
        Schema::create('siding_estimate_calculators', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('waste_percent_eave_rakes')->nullable();
            $table->string('waste_eave_rakes')->nullable();
            $table->string('eave_rakes_total')->nullable();
            $table->string('eave_rakes_subtotal')->nullable();
            $table->string('gutters_total')->nullable();
            $table->string('guards_total')->nullable();
            $table->string('downspout_total')->nullable();
            $table->string('eave_rakes_total_percent')->nullable();
            $table->string('soffit_eave')->nullable();
            $table->string('soffit_rakes')->nullable();
            $table->string('soffit_porch')->nullable();
            $table->string('soffit_eave_total')->nullable();
            $table->string('soffit_rakes_total')->nullable();
            $table->string('soffit_porch_total')->nullable();
            $table->string('soffit_eave_percent')->nullable();
            $table->string('soffit_rakes_percent')->nullable();
            $table->string('soffit_porch_percent')->nullable();
            $table->string('soffit_total_sum')->nullable();
            $table->string('note')->nullable();
            $table->string('soffit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siding_estimate_calculators');
    }
};
