@extends('admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
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
                                <!-- Error/Success Messages -->
                                @include('partials.messages')

                                <!-- Profile Photo Upload -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Profile Photo</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ auth()->user()->profile_photo_url }}" 
                                                 class="rounded-circle me-3" 
                                                 width="80" 
                                                 alt="Profile Photo">
                                            <input type="file" name="profile_photo" class="form-control">
                                        </div>
                                        <small class="text-muted">Max 2MB (JPEG, PNG, JPG)</small>
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control" 
                                               value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="tel" name="phone" class="form-control" 
                                               value="{{ old('phone', auth()->user()->phone) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date of Birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" name="dob" class="form-control" 
                                               value="{{ old('dob', auth()->user()->dob?->format('Y-m-d')) }}">
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

                                <!-- Address Information -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Present Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="present_address" class="form-control" rows="2">{{ old('present_address', auth()->user()->present_address) }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Permanent Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="permanent_address" class="form-control" rows="2">{{ old('permanent_address', auth()->user()->permanent_address) }}</textarea>
                                    </div>
                                </div>

                                <!-- Professional Information -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Qualifications</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="qualification" class="form-control" 
                                               value="{{ old('qualification', auth()->user()->qualification) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Graduation Institution</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="graduation_institution" class="form-control" 
                                               value="{{ old('graduation_institution', auth()->user()->graduation_institution) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Experience</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="experience" class="form-control" 
                                               value="{{ old('experience', auth()->user()->experience) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Specialization</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="specialization" class="form-control" 
                                               value="{{ old('specialization', auth()->user()->specialization) }}">
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4 w-100">
                                            <i class="bx bx-save me-1"></i> Update Profile
                                        </button>
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