@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Users</h1>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.manage-users') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3 mb-2">
                <input name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Search by name, email or phone">
            </div>
            <div class="col-md-2 mb-2">
                <select name="role" class="form-control">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ ($filters['role'] ?? '') === $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ ($filters['status'] ?? '') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100" type="submit">Filter</button>
            </div>
        </div>
    </form>

    {{-- User Table --}}
    @if($users->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Courses</th>
                    <th>Enrollments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="{{ $user->status === 'banned' ? 'table-danger' : '' }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ ucfirst($user->status) }}</td>
                    <td>{{ $user->courses->count() }}</td>
                    <td>{{ $user->enrollments->count() }}</td>
                    <td>
                        {{-- Approve Button --}}
                        @if($user->status === 'pending')
                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm" onclick="return confirm('Approve {{ $user->name }}?')">Approve</button>
                            </form>
                        @endif

                        {{-- Ban/Unban Button --}}
                        @if($user->status !== 'pending')
                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-warning btn-sm" onclick="return confirm('{{ $user->status === 'banned' ? 'Unban' : 'Ban' }} {{ $user->name }}?')">
                                    {{ $user->status === 'banned' ? 'Unban' : 'Ban' }}
                                </button>
                            </form>
                        @endif

                        {{-- Delete Button --}}
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete {{ $user->name }} permanently?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @else
        <div class="alert alert-info">No users found.</div>
    @endif
</div>
@endsection
