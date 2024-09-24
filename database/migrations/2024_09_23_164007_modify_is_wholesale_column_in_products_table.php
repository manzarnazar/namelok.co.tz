<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('is_wholesale')->nullable()->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Change back to the original data type and default value if needed
            $table->boolean('is_wholesale')->nullable()->default(null)->change();
        });
    }
};
