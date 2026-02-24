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
        Schema::create('year_estimations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('year')->nullable();
            $table->string('type', 191)->nullable();
            $table->string('estimate_amount')->nullable();
            $table->string('estimate_value')->nullable();
            $table->string('amount_per_job', 191)->nullable();
            $table->string('job_convertion_ratio', 191)->nullable();
            $table->string('extra_push', 191)->nullable();
            $table->string('status')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('year_estimations');
    }
};
