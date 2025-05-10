@foreach ($courses as $course)
    @php
        \Log::info('Course ID: ' . $course->id);
        \Log::info('Course Name: ' . $course->name);
        \Log::info('Course Class Timings: ' . ($course->class_timings ?? 'Class timings not available'));
    @endphp
    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
        <div>
            <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $course->name }}</h3>
            <p class="text-blue-700 mb-5">{{ $course->class_timings ?? 'Class timings not available' }}</p>
        </div>
        <a href="{{ route('tutor.quiz.upload', ['course' => $course->id]) }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-5 rounded shadow-md transition-colors text-center">
            Upload Quiz Questions
        </a>
    </div>
@endforeach@extends('layout')

@section('content')
<div class="container mx-auto px-6 py-8 bg-blue-50 min-h-screen">
    <h2 class="text-3xl font-semibold mb-8 text-blue-700">My Courses</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($courses as $course)
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                <div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $course->name }}</h3>
                    <p class="text-blue-700 mb-5">{{ $course->class_timings ?? 'Class timings not available' }}</p>
                </div>
                <a href="{{ route('tutor.quiz.upload', ['course' => $course->id]) }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-5 rounded shadow-md transition-colors text-center">
                    Upload Quiz Questions
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
