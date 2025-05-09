<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'user_type',
        'present_address',
        'permanent_address',
        'profile_photo',
        'student_id_card',
        'education_certificate',
        'nid_card',
        'password',
    
        // Student-specific
        'school_name',
        'class',
        'subject_interest',
        'learning_mode',
    
        // Tutor-specific
        'qualification',
        'graduation_institution',
        'experience',
        'specialization',
        'teaching_mode',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function unreadMessages()
    {
        return $this->hasMany(Message::class,'sender_id','id')->where('is_read',false);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id');
    }
}
