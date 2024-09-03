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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_wholesale')->default(false);
            $table->integer('minimum_wholesale_qty')->nullable();
            $table->integer('maximum_wholesale_qty')->nullable();
            $table->date('wholesale_expiry_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_wholesale', 'minimum_wholesale_qty', 'maximum_wholesale_qty,wholesale_expiry_date']);
        });
    }
};
