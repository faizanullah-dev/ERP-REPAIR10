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
        Schema::create('campaign_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('email_template_id')->nullable();
            $table->string('day')->nullable();
            $table->string('time')->nullable();
            $table->string('message_type')->nullable();
            $table->text('subject')->nullable();
            $table->text('message')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_details');
    }
};
