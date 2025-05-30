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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('no_registration', 25)->unique();
            $table->string('no_participant', 25)->unique()->nullable();
            $table->integer('token')->unique()->nullable();
            $table->foreignId('competition_id');
            $table->string('source_of_information', 50);
            $table->string('reason', 50);
            $table->boolean('is_first_competition')->default(0);
            $table->text('special_needs');
            $table->string('leader_name', 100);
            $table->string('leader_student_id', 50);
            $table->date('leader_date_of_birth');
            $table->char('leader_gender');
            $table->string('leader_no_wa', 20)->unique();
            $table->string('institution', 50);
            $table->string('institution_address');
            $table->string('institution_province', 50);
            $table->string('institution_city', 100);
            $table->string('parent_no_wa', 20);
            $table->string('pass_photo');
            $table->string('student_proof');
            $table->text('twibbon_links');
            $table->double('subtotal');
            $table->double('total');
            $table->string('transaction_proof');
            $table->boolean('is_accepted')->default(0);
            $table->text('reject_message')->nullable();
            $table->double('is_rejected')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
