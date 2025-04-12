<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Welcome, {{ $tutor->name }}</h2>
<p>Email: {{ $tutor->email }}</p>
<p>Specialization: {{ $tutor->specialization }}</p>
<p>Experience: {{ $tutor->experience }} years</p>
<img src="{{ Storage::url($tutor->profile_photo) }}" alt="Profile Photo" width="150">    
</body>
</html>