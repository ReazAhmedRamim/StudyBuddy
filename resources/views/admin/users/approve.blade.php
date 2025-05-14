
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            Approve User
        </div>
        <div class="card-body">
            <p>Are you sure you want to approve the following user?</p>
            <ul>
                <li><strong>Name:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
            </ul>

            <form method="POST" action="{{ route('admin.approve-user', $user->id) }}">
                @csrf
                @method('PATCH')

                <button type="submit" class="btn btn-success">Yes, Approve</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
