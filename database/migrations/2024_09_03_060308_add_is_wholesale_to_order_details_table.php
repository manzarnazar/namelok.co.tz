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
        if (!Schema::hasColumn('order_details', 'is_wholesale')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->boolean('is_wholesale')->default(0)->after('another_column');
            });
        }
    }
    
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('is_wholesale');
        });
    }
};
