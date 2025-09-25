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
        Schema::create('competition_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_attempt_id');
            $table->foreignId('question_id');
            $table->foreignId('answer_key')->nullable();
            $table->integer('question_number');
            $table->timestamps();

            $table->unique(['competition_attempt_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_answers');
    }
};
