<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseGoal extends Model
{
    protected $fillable = [
        'course_id',
        'goal_name'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function createCourseGoals($courseId, array $goals)
    {
        foreach ($goals as $goal) {
            CourseGoal::create([
                'course_id' => $courseId,
                'goal_name' => $goal
            ]);
        }
    }
}
