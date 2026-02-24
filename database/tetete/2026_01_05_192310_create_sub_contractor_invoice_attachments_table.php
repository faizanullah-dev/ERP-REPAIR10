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
        Schema::create('sub_contractor_invoice_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('invoice_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('rate')->nullable();
            $table->string('tax')->nullable();
            $table->string('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contractor_invoice_attachments');
    }
};
