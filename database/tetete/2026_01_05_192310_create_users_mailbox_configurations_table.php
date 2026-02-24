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
        Schema::create('users_mailbox_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_encryption_type')->nullable();
            $table->text('mail_username')->nullable();
            $table->string('password')->nullable();
            $table->string('mail_protocol')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_mailbox_configurations');
    }
};
