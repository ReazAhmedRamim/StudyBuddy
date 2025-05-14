<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User; // Add this import

class CreateCourseGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('course_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('goal_name');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');

            // Status field using User constants
            $table->enum('status', [
                User::STATUS_PENDING,
                User::STATUS_APPROVED,
                User::STATUS_BANNED
            ])->default(User::STATUS_PENDING);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_goals');
    }
};