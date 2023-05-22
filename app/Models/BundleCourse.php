<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',   
        'slug',  
        'selected_course', 
        'price', 
        'thumbnail', 
        'banner',
        'short_description',
        'status', 
    ];
}
