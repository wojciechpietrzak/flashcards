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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User learning the course
            $table->foreignId('set_id')->constrained()->onDelete('cascade');  // Set being learned
            $table->integer('total_boxes'); // Total number of boxes in the course
            $table->integer('last_accessed_box')->default(0); // Last box accessed (0 for artificial zero)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
