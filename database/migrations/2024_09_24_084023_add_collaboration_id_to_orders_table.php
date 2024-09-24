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
        Schema::table('orders', function (Blueprint $table) {
            // Add the collaboration_id column if it doesn't exist
            if (!Schema::hasColumn('orders', 'collaboration_id')) {
                $table->unsignedBigInteger('collaboration_id')->nullable();
            }

            // Define the foreign key constraint
            $table->foreign('collaboration_id')
                  ->references('id')->on('collaborations')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['collaboration_id']);

            // Drop the collaboration_id column if needed
            $table->dropColumn('collaboration_id');
        });
    }
};
