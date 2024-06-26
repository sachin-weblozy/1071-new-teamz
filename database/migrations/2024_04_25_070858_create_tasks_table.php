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
            $table->id();
            $table->unsignedBigInteger('space_id')->nullable();
            $table->text('title')->nullable();
            $table->string('assigned_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->dateTime('assign_date')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('priority')->nullable();
            $table->string('recurrence'); // daily/weekly/monthly/none
            $table->unsignedInteger('parent_id')->nullable(); // foreign key to itself
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
