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
        Schema::create('customer_communications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('user_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('cc')->nullable();
            $table->string('message')->nullable();
            $table->string('type')->nullable();
            $table->string('mail_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_communications');
    }
};
