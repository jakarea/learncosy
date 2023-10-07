<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'instructor_id',
        'module_id',
        'title',
        'slug',
        'video_link',
        'thumbnail',
        'short_description',
        'status',
        'type',
    ];
}
