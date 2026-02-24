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
        Schema::create('platform_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('model')->nullable();
            $table->string('title')->nullable();
            $table->string('user_id')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable()->default('unseen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_notifications');
    }
};
