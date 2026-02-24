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
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('customer_id')->nullable();
            $table->string('title')->nullable();
            $table->string('appointment_for_lead_id')->nullable();
            $table->string('attendees_user_id')->nullable();
            $table->string('team_id')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('additional_recipients')->nullable();
            $table->string('attachment')->nullable();
            $table->string('date_time_to')->nullable();
            $table->string('date_time_from')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->string('completion_status')->nullable()->default('incomplete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
