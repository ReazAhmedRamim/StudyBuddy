<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'instructor',
        'duration',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function classes()
    {
        return $this->hasMany(\App\Models\CourseClass::class, 'course_id', 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(\App\Models\Quiz::class, 'course_id', 'course_id');
    }
}
