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
        Schema::create('competition_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id');
            $table->dateTime('start_at')->nullable();
            $table->integer('correct_answer')->nullable();
            $table->integer('correct_hots_question')->nullable();
            $table->integer('wrong_answer')->nullable();
            $table->double('score')->nullable();
            $table->dateTime('finish_at')->nullable();
            $table->boolean('is_simulation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_attempts');
    }
};
