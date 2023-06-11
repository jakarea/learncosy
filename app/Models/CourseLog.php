<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'module_id',
        'lesson_id',
        'user_id',
    ];
}
