<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 
        'user_id', 
        'title',  
        'slug',  
        'number_of_lesson', 
        'number_of_attachment', 
        'number_of_video', 
        'duration',
        'status', 
    ];

    public function lessons(){
        return $this->hasMany(Lesson::class,'module_id','id');
    }
}
