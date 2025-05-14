@extends('tutor.master')

@section('content')
    <div class="page-content">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
        <h2>Hope you'll teach many things to our students.</h2>
    </div>
@endsection
