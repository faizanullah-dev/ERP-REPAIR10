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
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index('profiles_user_id_foreign');
            $table->string('customer_number')->nullable();
            $table->text('bio')->nullable();
            $table->text('title')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('pic')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip', 191)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('postal')->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('colour_id')->nullable();
            $table->string('category_id')->nullable();
            $table->integer('customer_owner_type_id')->nullable();
            $table->longText('upload_signature')->nullable();
            $table->string('signature_type', 191)->nullable();
            $table->longText('notes')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_postal_code')->nullable();
            $table->string('company_longitude')->nullable();
            $table->string('company_latitude')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_license_number')->nullable();
            $table->string('company_license')->nullable();
            $table->string('company_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
