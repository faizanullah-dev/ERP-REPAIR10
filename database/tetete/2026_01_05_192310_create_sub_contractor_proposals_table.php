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
        Schema::create('sub_contractor_proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('proposal_template_id')->nullable();
            $table->string('sub_contractor_id')->nullable();
            $table->string('status')->nullable();
            $table->longText('description')->nullable();
            $table->longText('signature')->nullable();
            $table->string('job_status')->nullable();
            $table->string('screen_shot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contractor_proposals');
    }
};
