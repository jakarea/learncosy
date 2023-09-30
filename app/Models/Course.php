<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Checkout;
use App\Models\course_like;
use App\Models\CourseReview;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'auto_complete',
        'user_id',
        'slug',
        'promo_video',
        'price',
        'offer_price',
        'categories',
        'thumbnail',
        'short_description',
        'description',
        'meta_keyword',
        'meta_description',
        'hascertificate',
        'sample_certificates',
        'status',
        'allow_review',
        'language',
        'platform',
        'objective',
        'curriculum',
        'objective_details',
    ];
    

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function modules(){
        return $this->hasMany(Module::class,'course_id','id');
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->withPivot('payment_method', 'amount', 'paid', 'start_at', 'end_at')
                    ->withTimestamps();
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->where('user_role', 'student')
                    ->withPivot('payment_method', 'amount', 'paid', 'start_at', 'end_at')
                    ->withTimestamps();
    }

    //attached checkouts
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function reviews(){
        return $this->hasMany(CourseReview::class,'course_id','id');
    }

    public function likes(){
        return $this->hasMany(course_like::class,'course_id','id');
    }
}
