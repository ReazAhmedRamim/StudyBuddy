<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // match with courses.id
            $table->string('title');
            $table->text('content')->nullable();
            $table->timestamps();

            // Foreign key constraint referencing courses.id
            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_contents');
    }
};

