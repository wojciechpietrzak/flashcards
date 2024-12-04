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
        Schema::create('flashcard_set', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flashcard_id')->constrained()->onDelete('cascade'); // Flashcard
            $table->foreignId('set_id')->constrained()->onDelete('cascade');       // Set
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcard_set');
    }
};
