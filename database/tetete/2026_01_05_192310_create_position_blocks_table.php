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
        Schema::create('position_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->string('insurance_rate')->nullable();
            $table->string('pay_rate_weekly')->nullable();
            $table->string('total_yearly_pay')->nullable();
            $table->string('cost_of_insurance')->nullable();
            $table->string('pay_rate_type')->nullable();
            $table->string('van')->nullable();
            $table->string('aut_insurance')->nullable();
            $table->string('state_federal_payment')->nullable();
            $table->string('state_federal_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_blocks');
    }
};
