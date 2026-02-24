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
        Schema::create('common_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('favicon')->nullable();
            $table->string('dashboard_logo')->nullable();
            $table->string('dashboard_logo_text')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('calendar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_settings');
    }
};
