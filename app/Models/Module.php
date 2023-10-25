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
        'status',
    ];

    public function lessons(){
        return $this->hasMany(Lesson::class,'module_id','id');
    }
}
