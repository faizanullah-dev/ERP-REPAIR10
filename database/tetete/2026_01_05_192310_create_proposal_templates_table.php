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
        Schema::create('proposal_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->binary('description')->nullable();
            $table->longText('page_template')->nullable();
            $table->string('screen_shot')->nullable();
            $table->binary('preview_image_screenshoot')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->string('proposal_type')->nullable();
            $table->unsignedInteger('order_index')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_templates');
    }
};
