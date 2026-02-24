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
        Schema::create('year_estimate_months', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('year_estimation_id')->nullable()->index('year_estimation_id');
            $table->string('name')->nullable();
            $table->string('percentage')->nullable();
            $table->string('amount')->nullable();
            $table->string('month_required_leads')->nullable();
            $table->string('month_needed_leads')->nullable();
            $table->string('extra_leads')->nullable();
            $table->string('extra_amount')->nullable();
            $table->string('unique_id', 191)->nullable();
            $table->string('status')->nullable()->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('year_estimate_months');
    }
};
