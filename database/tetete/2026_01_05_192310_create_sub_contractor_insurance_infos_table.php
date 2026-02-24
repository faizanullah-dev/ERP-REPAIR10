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
        Schema::create('sub_contractor_insurance_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('subcontractor_id')->nullable();
            $table->string('workers_compensation_insurance_company_info')->nullable();
            $table->string('workers_compensation_contact_name')->nullable();
            $table->string('workers_compensation_phone')->nullable();
            $table->string('workers_compensation_email')->nullable();
            $table->string('workers_compensation_insurance_carrier')->nullable();
            $table->string('workers_compensation_policy_eff')->nullable();
            $table->string('workers_compensation_policy_exp')->nullable();
            $table->string('workers_compensation_attachment')->nullable();
            $table->string('workers_compensation_attachment_date')->nullable();
            $table->string('general_liability_insurance_company_info')->nullable();
            $table->string('general_liability_contact_name')->nullable();
            $table->string('general_liability_phone')->nullable();
            $table->string('general_liability_email')->nullable();
            $table->string('general_liability_insurance_carrier')->nullable();
            $table->string('general_liability_policy_eff')->nullable();
            $table->string('general_liability_policy_exp')->nullable();
            $table->string('general_liability_attachment')->nullable();
            $table->string('general_liability_attachment_date')->nullable();
            $table->string('auto_insurance_company_info')->nullable();
            $table->string('auto_contact_name')->nullable();
            $table->string('auto_phone')->nullable();
            $table->string('auto_email')->nullable();
            $table->string('auto_insurance_carrier')->nullable();
            $table->string('auto_policy_eff')->nullable();
            $table->string('auto_policy_exp')->nullable();
            $table->string('auto_attachment')->nullable();
            $table->string('auto_attachment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contractor_insurance_infos');
    }
};
