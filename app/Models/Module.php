<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'instructor_id',
        'title',
        'slug',
        'reorder',
        'status',
    ];

    public function lessons(){
        return $this->hasMany(Lesson::class,'module_id','id');
    }

    public function courseActivities()
    {
        return $this->hasMany(CourseActivity::class);
    }

    public function isComplete()
    {
        $courseActivityCount = $this->courseActivities()->count();
        $lessonCount = $this->lessons()->count();

        return $courseActivityCount == $lessonCount;
    }
}
