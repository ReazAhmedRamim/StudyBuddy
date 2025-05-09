@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="bx bx-upload"></i> Upload Quiz Questions for: {{ $course->title }}</h2>

    <form action="{{ route('tutor.quiz.store', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="quiz_title" class="form-label">Quiz Title</label>
            <input type="text" class="form-control" id="quiz_title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="quiz_description" class="form-label">Quiz Description</label>
            <textarea class="form-control" id="quiz_description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="quiz_file" class="form-label">Upload Quiz Questions File</label>
            <input class="form-control" type="file" id="quiz_file" name="quiz_file" accept=".pdf,.doc,.docx,.txt" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload Quiz</button>
    </form>
</div>
@endsection
