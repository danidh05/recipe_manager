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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('ingredients');     // JSON array of strings
            $table->json('instructions');    // JSON array of steps
            $table->json('metadata')->nullable();  // Optional: cuisine type, prep time, calories
            $table->enum('status', ['favorite', 'to_try', 'made_before'])->default('to_try');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
