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
        Schema::create('receive_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('created_by')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('remaining_balance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_payments');
    }
};
