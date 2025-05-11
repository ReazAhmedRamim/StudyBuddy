<div class="d-flex align-items-center mb-3">
    <div class="flex-shrink-0">
        <img src="{{ $user->profile_photo_url }}" 
             class="rounded-circle" 
             width="40" 
             alt="{{ $user->name }}">
    </div>
    <div class="flex-grow-1 ms-3">
        <h6 class="mb-0">{{ $user->name }}</h6>
        <small class="text-muted">{{ $user->email }}</small>
    </div>
    <span class="badge bg-{{ $user->status_color }} ms-auto">
        {{ ucfirst($user->status) }}
    </span>
</div>
