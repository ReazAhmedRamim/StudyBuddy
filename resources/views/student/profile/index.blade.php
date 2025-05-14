@extends('student.master')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Student Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">student Profile</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">


                @include('student.profile.sidebar')
                 <!-- include('student.dashboard.sidebar') -->
                <div class="col-lg-8">

                    <div class="card">
                        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                        <!-- <form action="{{ route('student.dashboard.update') }}" method="POST" enctype="multipart/form-data"> -->
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif



                                <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                                <!-- <form method="POST" action="{{ route('student.dashboard.update') }}" enctype="multipart/form-data"> -->
  
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="tel" name="phone" class="form-control" value="{{ auth()->user()->phone }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Date of Birth</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="date" name="dob" class="form-control" value="{{ auth()->user()->dob }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="gender" class="form-select">
                                                <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ auth()->user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Present Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="present_address" class="form-control" value="{{ auth()->user()->present_address }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Permanent Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="permanent_address" class="form-control" value="{{ auth()->user()->permanent_address }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">School Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="school_name" class="form-control" value="{{ auth()->user()->school_name }}" placeholder="e.g., Sunshine High School" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Class</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="class" class="form-control" value="{{ auth()->user()->class }}" placeholder="e.g., 10th Grade" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Subjects of Interest</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="subject_interest" class="form-control" value="{{ auth()->user()->subject_interest }}" placeholder="e.g., Math, Science" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Learning Mode</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="learning_mode" class="form-select">
                                                <option value="online" {{ auth()->user()->learning_mode == 'online' ? 'selected' : '' }}>Online</option>
                                                <option value="offline" {{ auth()->user()->learning_mode == 'offline' ? 'selected' : '' }}>Offline</option>
                                                <option value="both" {{ auth()->user()->learning_mode == 'both' ? 'selected' : '' }}>Both</option>
                                            </select>
                                        </div>
                                    </div>

                                   

                                    

                                </form>







                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 w-100" value="Update" />
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>






                </div>
            </div>
        </div>
    </div>
</div>

@endsection