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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->integer('status')->nullable()->default(1)->comment('1-active,2-banned');
            $table->integer('customer_type_id')->nullable();
            $table->integer('salesman_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('company', 191)->nullable();
            $table->integer('referral_source_id')->nullable();
            $table->integer('reference_customer_id')->nullable();
            $table->text('customer_note')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('active_status')->nullable()->default(false);
            $table->string('avatar', 191)->nullable()->default('no_avatar.jpg');
            $table->boolean('dark_mode')->nullable()->default(false);
            $table->string('messenger_color', 191)->nullable()->default('#2180f3');
            $table->string('company_camp_creator_id', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
