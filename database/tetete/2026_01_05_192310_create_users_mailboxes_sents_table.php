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
        Schema::create('users_mailboxes_sents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->nullable();
            $table->string('configuration_email')->nullable();
            $table->string('uid')->nullable();
            $table->text('subject')->nullable();
            $table->text('from')->nullable();
            $table->text('to')->nullable();
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->text('message')->nullable();
            $table->text('date')->nullable();
            $table->text('mail_attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_mailboxes_sents');
    }
};
