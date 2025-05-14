<div class="card radius-10">
    <div class="card-header">
        <h6 class="mb-0">Student Management</h6>
    </div>
    <div class="card-body">
        @foreach ($students as $student)
            @if ($student->isStudent())
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <strong>{{ $student->name }}</strong><br>
                        <small>{{ $student->email }}</small><br>
                        <small>Status: {{ $student->approval_status }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        @if ($student->approval_status !== 'approved')
                            <form method="POST" action="{{ route('admin.users.approve', $student->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                            </form>
                        @endif

                        @if ($student->approval_status !== 'banned')
                            <form method="POST" action="{{ route('admin.users.ban', $student->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-danger">Ban</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
