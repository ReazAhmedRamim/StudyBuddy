@extends('layout')

@section('title', 'Login Page')

@section("content")
<div class="container">
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

  <form action="{{ route('login.post') }}" method="post" class="ms-auto me-auto mt-3" style="width: fit-content;">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
    </div>
    <div id="emailHelp" class="form-text">Your information is secure with us.</div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>

  <!-- Links for Register and Forgot Password -->
  <div class="mt-3 text-center">
    <p class="mb-1">Don't have an account? <a href="{{ route('reg') }}" class="text-primary">Register</a></p>
    <p><a href="{{ route('reg.post') }}" class="text-primary">Forgot your password?</a></p>
  </div>
</div>
@endsection
