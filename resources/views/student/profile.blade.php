<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Welcome, {{ $student->name }}</h2>
<p>Email: {{ $student->email }}</p>
<p>Specialization: {{ $student->specialization }}</p>
<p>Experience: {{ $student->experience }} years</p>
<img src="{{ Storage::url($student->profile_photo) }}" alt="Profile Photo" width="150">    
</body>
</html>