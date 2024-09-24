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
        Schema::table('collaborations', function (Blueprint $table) {
            // Add the note column as a text type
            $table->text('note')->nullable(); // Change to string if you want a shorter character limit
        });
    }

    public function down()
    {
        Schema::table('collaborations', function (Blueprint $table) {
            // Drop the note column if the migration is rolled back
            $table->dropColumn('note');
        });
    }
};
