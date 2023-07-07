<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 
        'module_id',  
        'title',  
        'slug',  
        'video_link',  
        'thumbnail',   
        'lesson_file',  
        'short_description',  
        'meta_keyword',  
        'meta_description',  
        'status', 
    ];
}
