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
        Schema::create('invoice_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('invoice_id')->nullable();
            $table->string('activity_name')->nullable();
            $table->string('category_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('rate')->nullable();
            $table->string('tax')->nullable();
            $table->string('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_attachments');
    }
};
