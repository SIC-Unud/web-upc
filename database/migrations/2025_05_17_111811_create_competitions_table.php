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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->text('description');
            $table->string('degree', 25);
            $table->double('wave_1_price');
            $table->double('wave_2_price');
            $table->double('wave_3_price');
            $table->boolean('is_team_competition');
            $table->boolean('is_cbt');
            $table->dateTime('start_competition')->nullable();
            $table->dateTime('end_competition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
