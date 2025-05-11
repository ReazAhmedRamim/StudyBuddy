@extends('layouts.admin')

@section('title', 'Ban User')

@section('content')
<div class="container mt-5">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h4>Ban User Confirmation</h4>
        </div>
        <div class="card-body">
            <p>Are you sure you want to <strong class="text-danger">ban</strong> this user?</p>

            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($user->approval_status) }}</li>
            </ul>

            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-danger">
                        Confirm Ban
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
