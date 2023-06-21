<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Course;
use App\Models\VimeoData;
use App\Models\Subscription;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_role',
        'username',
        'short_bio',
        'phone',
        'avatar',
        'social_links',
        'description',
        'recivingMessage',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * subscription
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'instructor_id');
    }

    public function courses(){
        return $this->hasMany(Course::class,'user_id');
    }

    /**
     * vimeo_data 
     */
    public function vimeo_data()
    {
        return $this->hasOne(VimeoData::class, 'user_id');
    }
}
