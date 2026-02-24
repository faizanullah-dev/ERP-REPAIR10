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
        Schema::create('sub_contractor_receiveables', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('invoice_id')->nullable();
            $table->string('job_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('created_by')->nullable();
            $table->string('remaining_balance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contractor_receiveables');
    }
};
