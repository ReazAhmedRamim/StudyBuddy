<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // SOLUTION: Add ALL fields you want to mass assign
    protected $fillable = [
        'tutor_id', 
        'course_title',
        'course_name',
        'course_name_slug',
        'description',
        'video_url',
        'label',
        'resources',
        'certificate',
        'selling_price',
        'discount_price',
        'prerequisites',
        'bestseller',
        'featured',
        'highestrated',
        'course_goals',
        'image'
    ];

    // Add casting for array fields
    protected $casts = [
        'course_goals' => 'array',
        'prerequisites' => 'array'
    ];
    public function goals()
    {
        return $this->hasMany(CourseGoal::class);
    }
}

