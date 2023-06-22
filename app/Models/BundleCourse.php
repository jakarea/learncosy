<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BundleCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   
        'title',   
        'slug',  
        'selected_course', 
        'subscription_status', 
        'price', 
        'thumbnail', 
        'banner',
        'short_description',
        'status', 
    ];

    // explode selected_course column and relationship with course table
    public function courses($couse_id)
    {
        $course_id = explode(',', $couse_id);
        return Course::whereIn('id', $course_id)->get();
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'selected_course', 'id');
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'bundle_courses', 'selected_course', 'id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getUserByCourseID($course_id)
    {
        return Checkout::where('course_id', $course_id)->pluck('user_id')->toArray();
    }

    public function getUserByCheckoutID($checkout_id)
    {
        return Checkout::where('id', $checkout_id)->pluck('user_id')->toArray();
    }

    public function getCheckoutByCourseID($course_id)
    {
        return Checkout::where('course_id', $course_id)->get();
    }

    public static function courseEnrolledByInstructor()
    {
        return Checkout::whereHas('course', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });
    }
}
