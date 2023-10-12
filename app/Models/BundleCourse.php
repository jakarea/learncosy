<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',   
        'title',   
        'sub_title',   
        'slug',  
        'selected_course', 
        'regular_price', 
        'sales_price', 
        'thumbnail', 
        'description'
    ];
}
