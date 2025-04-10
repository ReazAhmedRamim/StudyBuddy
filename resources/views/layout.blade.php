<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Optional custom CSS -->
  <style>
    body { background-color: #f5f7fa; }
    .card-register {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .form-control:focus {
      box-shadow: 0 0 0 .2rem rgba(102, 16, 242, .25);
      border-color: #6610f2;
    }
    .btn-primary {
      background-color: #6610f2;
      border-color: #6610f2;
    }
    .btn-primary:hover {
      background-color: #520dc2;
      border-color: #520dc2;
    }
    .section-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #333;
      margin-top: 1.5rem;
      margin-bottom: .75rem;
    }
  </style>
</head>
<body>
  @yield('content')

  <!-- Bootstrap 5 JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
