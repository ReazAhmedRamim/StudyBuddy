<div class="d-flex align-items-center mb-3">
    <div class="flex-shrink-0">
        <i class="bx bx-book-open fs-4"></i>
    </div>
    <div class="flex-grow-1 ms-3">
        <h6 class="mb-0">{{ $enrollment->course->course_title }}</h6>
        <small class="text-muted">
            {{ $enrollment->user->name }} - 
            {{ $enrollment->enrollment_date->format('M d, Y') }}
        </small>
    </div>
    <span class="badge bg-primary ms-auto">
        {{ ucfirst($enrollment->status) }}
    </span>
</div>