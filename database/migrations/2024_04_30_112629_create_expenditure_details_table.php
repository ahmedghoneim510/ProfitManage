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
        Schema::create('expenditure_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expenditure_id')->constrained()->cascadeOnDelete();
            $table->string('money');
            $table->string('month');
            $table->string('year');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditure_details');
    }
};