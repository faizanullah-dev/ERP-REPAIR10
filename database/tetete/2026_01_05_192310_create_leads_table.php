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
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_date')->nullable();
            $table->string('lead_status')->nullable()->default('new');
            $table->string('lead_status_date')->nullable();
            $table->string('job_number')->nullable();
            $table->string('company_camp_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('representative_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('lead_number')->nullable();
            $table->string('project_price')->nullable();
            $table->string('minimum_days')->nullable()->default('0');
            $table->string('maximum_days')->nullable()->default('0');
            $table->string('duration_minutes')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('stage_id')->nullable()->default('0');
            $table->string('stage_position')->nullable()->default('0');
            $table->text('other_information')->nullable();
            $table->string('tax_type', 191)->nullable();
            $table->string('lead_amount')->nullable();
            $table->string('tax', 191)->nullable();
            $table->string('lead_price', 191)->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->string('percentage_or_flat')->nullable();
            $table->string('percentage_flat_value')->nullable();
            $table->string('sales_commission')->nullable();
            $table->string('company_id')->nullable();
            $table->string('claim_number')->nullable();
            $table->string('policy_number')->nullable();
            $table->string('phone_insurance')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('email_insurance')->nullable();
            $table->string('adjust_name_insurance')->nullable();
            $table->string('adjust_Phone_insurance')->nullable();
            $table->string('adjust_email_insurance')->nullable();
            $table->string('contract_signed_date')->nullable();
            $table->string('date_loss_insurance')->nullable();
            $table->string('claim_filled_date')->nullable();
            $table->string('archive_status')->nullable()->default('archive');
            $table->string('lead_price_with_change_order_price')->nullable();
            $table->string('progress_status')->nullable();
            $table->string('position')->nullable();
            $table->string('product_template')->nullable();
            $table->string('lead_icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
