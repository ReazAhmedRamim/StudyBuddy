<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // User Roles
    const ROLE_ADMIN = 'admin';
    const ROLE_TUTOR = 'tutor';
    const ROLE_STUDENT = 'student';

    // User Statuses
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_BANNED = 'banned';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'role',
        'approval_status',
        'present_address',
        'permanent_address',
        'profile_photo',
        'student_id_card',
        'education_certificate',
        'nid_card',
        'school_name',
        'class',
        'subject_interest',
        'learning_mode',
        'qualification',
        'graduation_institution',
        'experience',
        'specialization',
        'teaching_mode'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'dob' => 'date',
    ];

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', self::STATUS_BANNED);
    }

    public function scopeTutors($query)
    {
        return $query->where('role', self::ROLE_TUTOR);
    }

    public function scopeStudents($query)
    {
        return $query->where('role', self::ROLE_STUDENT);
    }

    // Helpers
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTutor()
    {
        return $this->role === self::ROLE_TUTOR;
    }

    public function isStudent()
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isBanned()
    {
        return $this->status === self::STATUS_BANNED;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }
}