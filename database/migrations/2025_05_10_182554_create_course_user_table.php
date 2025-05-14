<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->foreignId('course_id')
                  ->constrained()
                  ->onDelete('cascade');
                  
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Additional pivot fields
            $table->enum('enrollment_status', [
                'pending',
                'approved',
                'rejected',
                'completed'
            ])->default('pending');
            
            $table->dateTime('enrolled_at')->useCurrent();
            $table->dateTime('completed_at')->nullable();

            $table->timestamps();

            // Composite unique key
            $table->unique(['course_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_user');
    }
};