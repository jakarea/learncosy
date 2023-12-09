<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstructorModuleSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'value',
        'logo',
        'app_logo',
        'image'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // get the value of the setting for use blade file globally
    public static function modulesetting($key)
    {
        $setting = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
        if ($setting) {
            $setting->value = json_decode($setting->value);
            return $setting->value->$key;
        }
        return null;
    }
}
