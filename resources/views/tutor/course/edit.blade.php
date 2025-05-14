@extends('tutor.master')

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Course</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card col-md-12">
            <div class="card-body p-4">
                <div style="display: flex; align-items:center; justify-content:space-between">
                    <h5>Edit Course</h5>
                    <a href="{{ route('tutor.course.index') }}" class="btn btn-primary">Back</a>
                </div>

                <form class="row g-3" method="POST" action="{{ route('tutor.course.update', $course->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="tutor_id" value="{{ auth()->user()->id }}"/>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" id="name"
                               value="{{ old('course_name', $course->course_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="course_name_slug" id="slug"
                               value="{{ old('course_name_slug', $course->course_name_slug) }}" required>
                    </div>

                    <div class="col-md-12">
                        <label for="course_title" class="form-label">Course Title</label>
                        <input type="text" class="form-control" name="course_title" id="course_title"
                               value="{{ old('course_title', $course->course_title) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        @if($course->image)
                            <img src="{{ $course->image }}" class="img-fluid mt-2" width="200">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="resources" class="form-label">Resources</label>
                        <input class="form-control" type="number" name="resources" id="resources"
                               value="{{ old('resources', $course->resources) }}">
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control editor" name="description" id="description">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="video_url" class="form-label">YouTube Video URL</label>
                        <input type="url" class="form-control" name="video_url" id="video_url"
                               value="{{ old('video_url', $course->video_url) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="label" class="form-label">Course Label</label>
                        <select class="form-select" name="label">
                            <option value="beginer" {{ $course->label == 'beginer' ? 'selected' : '' }}>Beginer</option>
                            <option value="medium" {{ $course->label == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="advance" {{ $course->label == 'advance' ? 'selected' : '' }}>Advance</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="certificate" class="form-label">Certificate</label>
                        <select class="form-select" name="certificate">
                            <option value="yes" {{ $course->certificate == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $course->certificate == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price"
                               value="{{ old('selling_price', $course->selling_price) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="discount_price" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price"
                               value="{{ old('discount_price', $course->discount_price) }}">
                    </div>

                    <div class="col-md-12">
                        <label for="prerequisites" class="form-label">Course Prerequisites</label>
                        <textarea class="form-control editor" name="prerequisites" id="prerequisites">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Course Goals</label>
                        @foreach($course_goals as $goal)
                            <input type="text" class="form-control mb-2" name="course_goals[]" value="{{ $goal->goal }}">
                        @endforeach
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addGoalField()">Add More</button>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success">Update Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function addGoalField() {
        const container = document.querySelector('[name="course_goals[]"]').parentNode;
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'course_goals[]';
        input.classList.add('form-control', 'mb-2');
        container.insertBefore(input, container.lastElementChild);
    }
</script>
@endpush
