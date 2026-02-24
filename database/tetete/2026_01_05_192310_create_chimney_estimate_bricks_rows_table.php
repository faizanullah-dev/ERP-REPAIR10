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
        Schema::create('chimney_estimate_bricks_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('chimney_estimate_calculator_id')->nullable();
            $table->string('section')->nullable();
            $table->string('bricks')->nullable();
            $table->string('rows')->nullable();
            $table->string('total_bricks_rows')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chimney_estimate_bricks_rows');
    }
};
