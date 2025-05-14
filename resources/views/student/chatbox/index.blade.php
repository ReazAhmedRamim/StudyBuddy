@extends('student.master')

@section('content')

<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">student Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">student Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="container">
        <div class="main-body">
            <div class="row">
                @include('student.sidebar')

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">List of Tutors</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th style="width: 120px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{route('chat',$user->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                                                    </svg>
                                                </a>
                                                <span id = "unread-count-{{$user->id}}" class=" {{ $user->unread_messages_count > 0 ? 'bg-danger text-white px-3 py-1 rounded-pill text-uppercase fw-bold small font-monospace shadow-sm' : ''}}">
                                                    {{$user->unread_messages_count > 0 ? $user->unread_messages_count : null}}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No users found.</td>
                                        </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div> <!-- col-lg-8 -->
            </div> <!-- row -->
        </div> <!-- main-body -->
    </div> <!-- container -->
</div> <!-- page-content -->

@endsection

<script type="module">
    window.Echo.private('unread-channel.{{ Auth::user()->id }}')
        .listen('UnreadMessage', (event) => {

            // Update unread message count in real-time
            const unreadCountElementCount = document.getElementById(`unread-count-${event.senderId}`);
            if (unreadCountElementCount) {

                event.unreadCountElementCount > 0 ? unreadCountElementCount.classList = 'bg-danger text-white px-3 py-1 rounded-pill text-uppercase fw-bold small font-monospace shadow-sm' : '';
                unreadCountElementCount.textContent = event.unreadMessageCount > 0 ? event.unreadMessageCount : '';
            }  
        });
</script>