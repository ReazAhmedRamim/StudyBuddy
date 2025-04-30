<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseContentsTable extends Migration
{
    public function up()
    {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->increments('content_id');
            $table->unsignedInteger('course_id');
            $table->string('content_type', 50);
            $table->string('file_path', 255)->nullable();
            $table->timestamp('uploaded_at')->useCurrent();

            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_contents');
    }
}
