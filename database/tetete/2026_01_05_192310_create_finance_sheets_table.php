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
        Schema::create('finance_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('year_estimation_id')->nullable();
            $table->string('total_gross_income')->nullable();
            $table->string('total_cogs')->nullable();
            $table->string('total_gross_marging')->nullable();
            $table->string('total_oh_expense')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_sheets');
    }
};
