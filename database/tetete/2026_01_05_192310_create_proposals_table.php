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
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->string('proposal_template_id')->nullable();
            $table->string('lead_id')->nullable();
            $table->longText('description')->nullable();
            $table->longText('screen_shot')->nullable();
            $table->longText('signature')->nullable();
            $table->string('created_by')->nullable();
            $table->longText('customer_description')->nullable();
            $table->enum('status', ['draft', 'sent', 'save'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
