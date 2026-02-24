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
        Schema::create('sub_contractor_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('invoice_unique_id')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('job_id')->nullable();
            $table->string('bill_to')->nullable();
            $table->string('bill_from')->nullable();
            $table->string('subcontractor_id')->nullable();
            $table->string('address')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('tax')->nullable();
            $table->string('total')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->integer('is_send')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contractor_invoices');
    }
};
