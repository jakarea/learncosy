<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkouts';

    protected $fillable = [
        'user_id',
        'course_id',
        'payment_method',
        'payment_status',
        'payment_id',
        'status',
        'amount',
        'start_date',
        'end_date',
    ];

    /**
     * Public boot function
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
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

    // get student payment by course user id is equal to auth user id and course id is equal to course id
    
}
