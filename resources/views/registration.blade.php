@extends('layout')

@section('title', 'Registration')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card card-register p-4">
        <h2 class="text-center mb-4">User Registration</h2>
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>

        <form action="{{ route('reg.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <!-- Basic Info -->
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Mobile Number</label>
              <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-select" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Register As</label>
              <select id="userType" name="user_type" class="form-select" required>
                <option value="" disabled selected>Select user type</option>
                <option value="student">Student</option>
                <option value="tutor">Tutor</option>
              </select>
            </div>
          </div>

          <!-- Address -->
          <div class="section-title">Address Details</div>
          <div class="mb-3">
            <label class="form-label">Present Address</label>
            <textarea name="present_address" class="form-control" rows="2" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Permanent Address</label>
            <textarea name="permanent_address" class="form-control" rows="2" required></textarea>
          </div>

          <!-- File Uploads -->
          <div class="section-title">Upload Photos</div>
          <div class="mb-3">
            <label class="form-label">Profile Photo</label>
            <input type="file" name="profile_photo" accept="image/*" class="form-control" required>
          </div>

          <!-- Student Fields -->
          <div id="studentFields" class="d-none">
            <div class="section-title">Student Information</div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Institution Name</label>
                <input type="text" name="school_name" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Class/Grade</label>
                <input type="text" name="class" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Subjects Interested In</label>
                <input type="text" name="subject_interest" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Preferred Learning Mode</label>
                <select name="learning_mode" class="form-select">
                  <option value="" disabled selected>Select Mode</option>
                  <option value="online">Online</option>
                  <option value="offline">Offline</option>
                  <option value="both">Both</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Student ID Card Photo</label>
                <input type="file" name="nid_card" accept="image/*" class="form-control">
              </div>
            </div>
          </div>

          <!-- Tutor Fields -->
          <div id="tutorFields" class="d-none">
            <div class="section-title">Tutor Information</div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Highest Qualification</label>
                <input type="text" name="qualification" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Graduation Institution</label>
                <input type="text" name="graduation_institution" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Years of Experience</label>
                <input type="number" name="experience" min="0" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Subjects Specialization</label>
                <input type="text" name="specialization" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Available Teaching Mode</label>
                <select name="teaching_mode" class="form-select">
                  <option value="" disabled selected>Select Mode</option>
                  <option value="online">Online</option>
                  <option value="offline">Offline</option>
                  <option value="both">Both</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Educational Certificate</label>
                <input type="file" name="education_certificate" accept=".pdf,image/*" class="form-control">
              </div>
              <div class="col-12">
                <label class="form-label">NID Card Photo</label>
                <input type="file" name="nid_card" accept="image/*" class="form-control">
              </div>
            </div>
          </div>

          <!-- Security -->
          <div class="section-title">Security</div>
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
          </div>

          <!-- Terms & Submit -->
          <div class="form-check mb-3">
            <input id="terms" type="checkbox" class="form-check-input" required>
            <label for="terms" class="form-check-label">I agree to the terms and conditions</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Complete Registration</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const userType = document.getElementById('userType');
    const studentFields = document.getElementById('studentFields');
    const tutorFields = document.getElementById('tutorFields');

    userType.addEventListener('change', () => {
      if (userType.value === 'student') {
        studentFields.classList.remove('d-none');
        tutorFields.classList.add('d-none');
      } else if (userType.value === 'tutor') {
        tutorFields.classList.remove('d-none');
        studentFields.classList.add('d-none');
      } else {
        studentFields.classList.add('d-none');
        tutorFields.classList.add('d-none');
      }
    });
  });
</script>
@endpush
@endsection