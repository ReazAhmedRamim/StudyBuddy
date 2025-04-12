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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('user_type', ['student', 'tutor',"admin"]);
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('student_id_card')->nullable();
            $table->string('education_certificate')->nullable();
            $table->string('nid_card')->nullable();
            $table->string('school_name')->nullable();
            $table->string('class')->nullable();
            $table->string('subject_interest')->nullable();
            $table->string('learning_mode')->nullable();
            $table->string('qualification')->nullable();
            $table->string('graduation_institution')->nullable();
            $table->string('experience')->nullable();
            $table->string('specialization')->nullable();
            $table->string('teaching_mode')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
