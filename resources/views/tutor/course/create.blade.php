@extends('tutor.master')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Course</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card col-md-12">
        <div class="card-body p-4">
            <div style="display: flex; align-items:center; justify-content:space-between">
                <h5 class="mb-4">Add Course</h5>
                <a href="{{ route('tutor.course.index') }}" class="btn btn-primary">Back</a>
            </div>

            <form class="row g-3" method="post" action="{{ route('tutor.course.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <input type="hidden" name="tutor_id" value="{{ auth()->user()->id }}" />

                <div class="col-md-6">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="course_name" id="name"
                        placeholder="Enter the course name" value="{{ old('course_name') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" name="course_name_slug" id="slug"
                        placeholder="Enter the slug" value="{{ old('course_name_slug') }}" required>
                </div>

                <div class="col-md-12">
                    <label for="course_title" class="form-label">Course Title</label>
                    <input type="text" class="form-control" name="course_title" id="course_title"
                        placeholder="Enter the course title" value="{{ old('course_title') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="Photo" accept="image/*">
                    <div style="margin-top: 10px">
                        <img src="" id="photoPreview" class="img-fluid" style="margin-top: 15px; display: none;" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="resources" class="form-label">Resources</label>
                    <input class="form-control" type="number" name="resources" id="resources"
                        placeholder="Enter the Number of Download Resource" value="{{ old('resources') }}" />
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control editor" name="description" id="description" required>{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="video_url" class="form-label">YouTube Video URL</label>
                    <input type="url" class="form-control" name="video_url" id="video_url"
                        placeholder="Enter the YouTube video URL" value="{{ old('video_url') }}" required>
                    <iframe id="videoPreview" style="margin-top: 15px; display: none; width: 100%; height: 400px;"
                        frameborder="0" allowfullscreen></iframe>
                </div>

                <div class="col-md-6">
                    <label for="label" class="form-label">Course Label</label>
                    <select class="form-select" name="label" id="label">
                        <option disabled selected>Select</option>
                        <option value="beginer" {{ old('label') == 'beginer' ? 'selected' : '' }}>Beginer</option>
                        <option value="medium" {{ old('label') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="advance" {{ old('label') == 'advance' ? 'selected' : '' }}>Advance</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="certificate" class="form-label">Certificate</label>
                    <select class="form-select" name="certificate" id="certificate">
                        <option disabled selected>Select</option>
                        <option value="yes" {{ old('certificate') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ old('certificate') == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="selling_price" class="form-label">Selling Price</label>
                    <input type="number" class="form-control" name="selling_price" id="selling_price"
                        placeholder="Enter selling price" value="{{ old('selling_price') }}" />
                </div>

                <div class="col-md-6">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="number" class="form-control" name="discount_price" id="discount_price"
                        placeholder="Enter discount price" value="{{ old('discount_price') }}" />
                </div>

                <div class="col-md-12">
                    <label for="prerequisites" class="form-label">Course Prerequisites</label>
                    <textarea class="form-control editor" name="prerequisites" id="prerequisites">{{ old('prerequisites') }}</textarea>
                </div>

                <div class="col-md-12">
                    <label for="course_goal" class="form-label">Course Goals</label>
                    <div id="goalContainer">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <input type="text" class="form-control" name="course_goals[]" placeholder="Enter Course Goal" />
                            <button type="button" id="addGoalInput" class="btn btn-primary">+</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mt-3">
                    <div class="form-check form-check-success">
                        <input type="hidden" name="bestseller" value="no">
                        <input class="form-check-input" type="checkbox" name="bestseller" value="yes" id="flexCheckSuccess">
                        <label class="form-check-label" for="flexCheckSuccess">Bestseller</label>
                    </div>

                    <div class="form-check form-check-danger">
                        <input type="hidden" name="featured" value="no">
                        <input class="form-check-input" type="checkbox" name="featured" value="yes" id="flexCheckDanger">
                        <label class="form-check-label" for="flexCheckDanger">Featured</label>
                    </div>

                    <div class="form-check form-check-warning">
                        <input type="hidden" name="highestrated" value="no">
                        <input class="form-check-input" type="checkbox" name="highestrated" value="yes" id="flexCheckWarning">
                        <label class="form-check-label" for="flexCheckWarning">Highest Rated</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4 w-100">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('video_url').addEventListener('input', function () {
        const videoUrl = this.value;
        const videoPreview = document.getElementById('videoPreview');
        const videoId = extractYouTubeID(videoUrl);
        if (videoId) {
            videoPreview.src = `https://www.youtube.com/embed/${videoId}`;
            videoPreview.style.display = 'block';
        } else {
            videoPreview.style.display = 'none';
            videoPreview.src = '';
        }
    });

    function extractYouTubeID(url) {
        const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }

    document.getElementById('Photo').addEventListener('change', function (e) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById('photoPreview');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    });

    document.getElementById('addGoalInput').addEventListener('click', function () {
        const container = document.getElementById('goalContainer');
        const inputGroup = document.createElement('div');
        inputGroup.style.cssText = "display:flex; align-items:center; gap:10px; margin-bottom:10px;";
        inputGroup.innerHTML = `<input type="text" class="form-control" name="course_goals[]" placeholder="Enter Course Goal" />
                                <button type="button" class="btn btn-danger removeGoal">-</button>`;
        container.appendChild(inputGroup);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeGoal')) {
            e.target.parentElement.remove();
        }
    });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
