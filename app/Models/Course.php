<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $guarded = [];

    public function goals(): HasMany
    {
        return $this->hasMany(CourseGoal::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id')->withTimestamps();
    }

    public function classes(): HasMany
    {
        return $this->hasMany(CourseClass::class, 'course_id', 'id');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class, 'course_id', 'id');
    }
}
