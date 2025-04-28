@extends('admin.master')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">admin Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">admin Profile</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">


                @include('admin.profile.sidebar')
                <div class="col-lg-8">

                    <div class="card">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
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
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" />
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
                                        <select class="form-select" name="gender">
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
                                        <h6 class="mb-0">Qualification</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="qualification" class="form-control" value="{{ auth()->user()->qualification }}" placeholder="e.g., MSc in Mathematics" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Graduation Institution</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="graduation_institution" class="form-control" value="{{ auth()->user()->graduation_institution }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Experience</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="experience" class="form-control" value="{{ auth()->user()->experience }}" placeholder="e.g., 3 years teaching Math" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Specialization</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="specialization" class="form-control" value="{{ auth()->user()->specialization }}" placeholder="e.g., Algebra, Geometry, Calculus" />
                                    </div>
                                </div>

                                

                                



                                



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