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
        Schema::create('sub_contractor_recurring_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('email_template_id')->nullable();
            $table->string('subcontractor_id')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('no_of_days_before')->nullable();
            $table->string('same_agency')->nullable()->default('0');
            $table->string('policy_expiry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contractor_recurring_emails');
    }
};
