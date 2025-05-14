@extends('tutor.master')

@section('title', 'My Courses')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>My Courses ({{ $all_courses->count() }})</h4>
        <a href="{{ route('tutor.course.create') }}" class="btn btn-success">Add New Course</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>YouTube Link</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($all_courses as $index => $course)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        {{-- Extract YouTube video ID for thumbnail --}}
                        @php
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w\-]+)/', $course->video_url, $matches);
                            $videoId = $matches[1] ?? null;
                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/0.jpg" : null;
                        @endphp
                        <td>
                            @if($thumbnailUrl)
                                <img src="{{ $thumbnailUrl }}" alt="Thumbnail" width="120">
                            @else
                                <span class="text-muted">No Video</span>
                            @endif
                        </td>

                        <td>{{ $course->course_title ?? 'No Title' }}</td>

                        <td>
                            @if($course->video_url)
                                <a href="{{ $course->video_url }}" target="_blank">Watch</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>

                        <td>
                            @if($course->discount_price)
                                <del>${{ number_format($course->selling_price, 2) }}</del><br>
                                <span class="text-success fw-bold">${{ number_format($course->discount_price, 2) }}</span>
                            @else
                                ${{ number_format($course->selling_price, 2) }}
                            @endif
                        </td>

                        <td>{{ $course->created_at->format('d M Y') }}</td>

                        <td class="d-flex gap-2">
                            <a href="{{ route('tutor.course.edit', $course->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <form action="{{ route('tutor.course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
