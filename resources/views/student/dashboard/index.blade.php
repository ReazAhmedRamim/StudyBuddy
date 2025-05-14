@extends('student.master')

@section('content')
<div class="container mx-auto p-4">
    <div>
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
        <h2>Hope you'll learn many things with us.</h2>
    </div>
</div>
@endsection
