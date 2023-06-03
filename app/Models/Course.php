<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Checkout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'user_id',
        'features',
        'slug', 
        'prerequisites', 
        'outcome', 
        'promo_video', 
        'price', 
        'offer_price', 
        'categories', 
        'thumbnail', 
        'banner', 
        'short_description', 
        'description', 
        'meta_keyword', 
        'meta_description', 
        'number_of_module', 
        'number_of_lesson', 
        'number_of_quiz', 
        'number_of_attachment', 
        'number_of_video', 
        'duration', 
        'hascertificate', 
        'sample_certificates', 
        'subscription_status', 
        'status', 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
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
                    ->where('role', 'student')
                    ->withPivot('payment_method', 'amount', 'paid', 'start_at', 'end_at')
                    ->withTimestamps();
    }

    //attached checkouts
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
    
}
