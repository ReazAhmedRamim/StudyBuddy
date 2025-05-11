<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // === Role Constants ===
    public const ROLE_ADMIN = 'admin';
    public const ROLE_TUTOR = 'tutor';
    public const ROLE_STUDENT = 'student';

    // === Approval Status Constants ===
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_BANNED = 'banned';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'role',
        'approval_status',
        'present_address',
        'permanent_address',
        'profile_photo',
        'password',
        'school_name',
        'class',
        'subject_interest',
        'learning_mode',
        'qualification',
        'graduation_institution',
        'experience',
        'specialization',
        'teaching_mode',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'dob' => 'date',
        'email_verified_at' => 'datetime',
    ];

    // === Role Check Methods ===

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN; // You can differentiate later if needed
    }

    public function hasAdminAccess(): bool
    {
        return $this->isAdmin();
    }
    public function isTutor(): bool
    {
        return $this->role === self::ROLE_TUTOR;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    // === Approval Status Methods ===

    public function isBanned(): bool
    {
        return $this->approval_status === self::STATUS_BANNED;
    }

    public function isApproved(): bool
    {
        return $this->isAdmin() || $this->approval_status === self::STATUS_APPROVED;
    }

    public function isPending(): bool
    {
        return $this->approval_status === self::STATUS_PENDING;
    }

    // === Scopes ===

    public function scopeApproved($query)
    {
        return $query->where('approval_status', self::STATUS_APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('approval_status', self::STATUS_PENDING);
    }

    public function scopeBanned($query)
    {
        return $query->where('approval_status', self::STATUS_BANNED);
    }

    public function scopeApprovedTutors($query)
    {
        return $query->where('role', self::ROLE_TUTOR)
                     ->where('approval_status', self::STATUS_APPROVED);
    }

    public function scopePendingTutors($query)
    {
        return $query->where('role', self::ROLE_TUTOR)
                     ->where('approval_status', self::STATUS_PENDING);
    }

    public function scopeBannedTutors($query)
    {
        return $query->where('role', self::ROLE_TUTOR)
                     ->where('approval_status', self::STATUS_BANNED);
    }

    public function scopeTutors($query)
    {
        return $query->where('role', self::ROLE_TUTOR);
    }

    public function scopeStudents($query)
    {
        return $query->where('role', self::ROLE_STUDENT);
    }

    // === Relationships ===

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_user')
                    ->withTimestamps()
                    ->withPivot('enrollment_status');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    // === Accessors ===

    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->profile_photo
            ? Storage::url($this->profile_photo)
            : asset('images/default-avatar.png');
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->approval_status) {
            self::STATUS_APPROVED => 'success',
            self::STATUS_BANNED => 'danger',
            default => 'warning',
        };
    }

    public function getRoleBadgeAttribute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => '<span class="badge bg-danger">Admin</span>',
            self::ROLE_TUTOR => '<span class="badge bg-warning">Tutor</span>',
            default => '<span class="badge bg-primary">Student</span>',
        };
    }
}
