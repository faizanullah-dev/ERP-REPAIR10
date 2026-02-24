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
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('lead_id')->nullable();
            $table->string('message')->nullable();
            $table->string('message_type', 191)->nullable()->default('outgoing');
            $table->text('twilio_message_sid')->nullable();
            $table->string('reply_from', 191)->nullable();
            $table->string('send_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
