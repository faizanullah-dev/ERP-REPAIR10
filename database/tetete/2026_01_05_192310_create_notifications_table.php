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
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('icon')->nullable();
            $table->string('view_id')->nullable()->default('1');
            $table->string('model')->nullable();
            $table->string('title')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('time')->nullable();
            $table->string('status')->nullable()->default('unseen');
            $table->string('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
