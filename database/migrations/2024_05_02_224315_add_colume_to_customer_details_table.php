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
        Schema::table('customer_details', function (Blueprint $table) {
            $table->dropUnique('customer_details_month_year_unique'); // Drop existing unique constraint
            $table->unique(['month', 'year', 'customer_id']); // Create new unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->dropUnique('customer_details_month_year_customer_id_unique'); // Drop unique constraint
        });
    }
};
