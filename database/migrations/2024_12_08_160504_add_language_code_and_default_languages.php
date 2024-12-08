<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'code' column to 'languages' table
        Schema::table('languages', function (Blueprint $table) {
            $table->string('code')->unique()->after('name');
        });

        // Insert default languages (English, Polish, and German) into 'languages' table
        DB::table('languages')->insert([
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'Polski', 'code' => 'pl'],
            ['name' => 'Deutsch', 'code' => 'de'],
        ]);

        // Update the 'users' table to set 'language_id' to the 'English' language for all existing users
        $englishLanguage = DB::table('languages')->where('code', 'en')->first();
        DB::table('users')->update(['language_id' => $englishLanguage->id]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
