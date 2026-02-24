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
        Schema::create('email_brandings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->longText('pre_body_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->longText('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_position')->nullable();
            $table->string('logo_alignment')->nullable();
            $table->string('logo_background')->nullable();
            $table->string('social_link_one')->nullable();
            $table->string('social_link_two')->nullable();
            $table->string('social_link_three')->nullable();
            $table->string('social_link_four')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_brandings');
    }
};
