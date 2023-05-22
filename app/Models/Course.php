<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
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
    
}
