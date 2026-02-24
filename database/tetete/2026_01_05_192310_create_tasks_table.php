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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('progress_name')->nullable();
            $table->string('title')->nullable();
            $table->string('priority_id')->nullable();
            $table->string('assign_to_user_id')->nullable();
            $table->string('due_date')->nullable();
            $table->string('assign_to_lead_id')->nullable();
            $table->string('assign_to_team_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
