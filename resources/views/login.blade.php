<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('section.link')
    <title>Studybuddy</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <!-- Left Side (Image) -->
                    <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('backend/assets/images/login-images/login-cover.svg') }}"
                                     class="img-fluid auth-img-cover-login" width="650" alt="Login Image" />
                            </div>
                        </div>
                    </div>

                    <!-- Right Side (Login Form) -->
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('backend/assets/images/logo-icon.png') }}" width="60" alt="Logo">
                                    </div>
                                    <h5 class="">StudyBuddy</h5>
                                    <p class="mb-0">Please log in to your account</p>
                                </div>

                                <!-- Display Errors -->
                                <div class="mt-4">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <div>{{ $error }}</div>
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

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login.post') }}" class="ms-auto me-auto mt-3" style="width: fit-content;">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                    </div>

                                    <div class="form-text mb-3">Your information is secure with us.</div>

                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </form>

                                <!-- Register / Forgot Password Links -->
                                <div class="mt-4 text-center">
                                    <p class="mb-1">Don't have an account?
                                        <a href="{{ route('reg') }}" class="text-primary">Register</a>
                                    </p>
                                    <p><a href="{{ route('reg.post') }}" class="text-primary">Forgot your password?</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>
    </div><!--end wrapper-->

    @include('section.script')
</body>

</html>
