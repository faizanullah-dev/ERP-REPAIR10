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
        Schema::create('finance_gross_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('finance_sheet_id')->nullable();
            $table->string('payroll')->nullable();
            $table->string('owner_pay')->nullable();
            $table->string('merchant_fee')->nullable();
            $table->string('employee_training')->nullable();
            $table->string('advertising_marketing')->nullable();
            $table->string('bank_charges')->nullable();
            $table->string('dues_subscription')->nullable();
            $table->string('insurance')->nullable();
            $table->string('legal')->nullable();
            $table->string('office_computer')->nullable();
            $table->string('rent_lease')->nullable();
            $table->string('taxes')->nullable();
            $table->string('travel')->nullable();
            $table->string('utilities')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('clipper')->nullable();
            $table->string('advance_magazine')->nullable();
            $table->string('google_adds')->nullable();
            $table->string('social_media')->nullable();
            $table->string('total_advertising_marketing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_gross_expenses');
    }
};
