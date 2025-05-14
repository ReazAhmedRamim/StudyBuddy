<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Welcome, {{ $admin->name }}</h2>
<p>Email: {{ $admin->email }}</p>
<p>Specialization: {{ $admin->specialization }}</p>
<p>Experience: {{ $admin->experience }} years</p>
<img src="{{ Storage::url($admin->profile_photo) }}" alt="Profile Photo" width="150">    
</body>
</html>