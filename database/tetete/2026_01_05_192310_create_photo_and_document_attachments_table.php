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
        Schema::create('photo_and_document_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('document_id')->nullable();
            $table->string('name')->nullable();
            $table->string('doc_primary')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('file_name')->nullable();
            $table->string('company_camp_id')->nullable();
            $table->string('company_camp_file_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_and_document_attachments');
    }
};
