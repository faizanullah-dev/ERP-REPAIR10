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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('invoice_unique_id')->nullable();
            $table->string('address')->nullable();
            $table->string('due_date')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('total_tax')->nullable();
            $table->string('sub_total')->nullable();
            $table->text('description')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('receipt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
