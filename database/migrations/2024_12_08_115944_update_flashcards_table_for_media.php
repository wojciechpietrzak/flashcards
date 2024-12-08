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
        Schema::table('flashcards', function (Blueprint $table) {
            $table->text('question')->nullable()->change();  // Change question to nullable text
            $table->text('answer')->nullable()->change();    // Change answer to nullable text
            $table->string('question_image')->nullable();         // Path to question image
            $table->string('answer_image')->nullable();           // Path to answer image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flashcards', function (Blueprint $table) {
            $table->string('question')->change();    // Revert to original string column
            $table->string('answer')->change();      // Revert to original string column
            $table->dropColumn('question_image');    // Drop question image column
            $table->dropColumn('answer_image');      // Drop answer image column
        });
    }
};
