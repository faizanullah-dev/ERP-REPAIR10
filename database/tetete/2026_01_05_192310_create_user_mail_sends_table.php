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
        Schema::create('user_mail_sends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->nullable();
            $table->text('subject')->nullable();
            $table->longText('message')->nullable();
            $table->string('configuration_email')->nullable();
            $table->integer('user_mailbox_type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('picture')->nullable();
            $table->text('to')->nullable();
            $table->text('from')->nullable();
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->text('date')->nullable();
            $table->string('is_seen', 5)->nullable()->default('1');
            $table->string('is_starred', 5)->nullable()->default('0');
            $table->text('mail_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_mail_sends');
    }
};
