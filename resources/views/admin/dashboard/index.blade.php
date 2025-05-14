@extends('admin.master')

@section('content')
<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Overview</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Stats -->
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon bg-light-primary text-primary">
                            <i class="bx bxs-graduation"></i>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-0">{{ $tutors->count() }}</h4>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Total Tutors</p>
                        <p class="mb-0 text-secondary">{{ $pendingTutors }} pending approval</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon bg-light-success text-success">
                            <i class="bx bxs-user-account"></i>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-0">{{ $students->count() }}</h4>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Total Students</p>
                        <p class="mb-0 text-secondary">{{ $pendingStudents }} pending approval</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon bg-light-warning text-warning">
                            <i class="bx bxs-book"></i>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-0">{{ $activeCourses }}</h4>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Active Courses</p>
                        <p class="mb-0 text-secondary">{{ $newCoursesThisMonth }} new this month</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon bg-light-danger text-danger">
                            <i class="bx bxs-lock-alt"></i>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-0">{{ $bannedUsers->count() }}</h4>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Banned Users</p>
                        <p class="mb-0 text-secondary">{{ $bannedTutors }} tutors, {{ $bannedStudents }} students</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Sections -->
    <div class="row mt-4">
        <div class="col-12 col-lg-6">
            @include('admin.dashboard.partials.tutor-management')
        </div>
        <div class="col-12 col-lg-6">
            @include('admin.dashboard.partials.student-management')
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card radius-10">
                <div class="card-header">
                    <h6 class="mb-0">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- New Users -->
                        <div class="col-md-6">
                            <h6 class="mb-3">New Users</h6>
                            @foreach($recentUsers as $user)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $user->profile_photo_url }}" class="rounded-circle" width="40">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    <span class="badge bg-{{ $user->status_color }} ms-auto">{{ ucfirst($user->status) }}</span>
                                </div>
                                <div class="d-flex gap-2 mb-3">
                                    @if ($user->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    @endif
                                    @if ($user->status !== 'banned')
                                        <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm">Ban</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Recent Enrollments -->
                        <div class="col-md-6">
                            <h6 class="mb-3">Recent Enrollments</h6>
                            @foreach($recentEnrollments as $enrollment)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-book-open fs-4 me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $enrollment->course->course_title }}</h6>
                                        <small>{{ $enrollment->user->name }} - {{ $enrollment->enrollment_date->format('M d, Y') }}</small>
                                    </div>
                                    <span class="badge bg-primary ms-auto">{{ ucfirst($enrollment->status) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
