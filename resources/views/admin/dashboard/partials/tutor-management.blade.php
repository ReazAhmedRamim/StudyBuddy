<div class="card radius-10">
    <div class="card-header">
        <h6 class="mb-0">Tutor Management</h6>
    </div>
    <div class="card-body">
        @foreach ($tutors as $tutor)
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <strong>{{ $tutor->name }}</strong><br>
                    <small>{{ $tutor->email }}</small><br>
                    <small>Status: {{ $tutor->approval_status }}</small>
                </div>
                <div class="d-flex gap-2">
                    @if ($tutor->approval_status !== 'approved')
                        <form method="POST" action="{{ route('admin.users.approve', $tutor->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>
                    @endif

                    @if ($tutor->approval_status !== 'banned')
                        <form method="POST" action="{{ route('admin.users.ban', $tutor->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger">Ban</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

