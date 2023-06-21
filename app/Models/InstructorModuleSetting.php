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
        'value'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // {"banner_title":"New banner title","banner_text":"Welcome to your amazing app. Feel free to login and start managing your projects and clients.","button_text":"Get Started","button_link":"#","primary_color":"#47c2ff","secondary_color":"#5a5858","logo":{},"image":{}}

    // I want to access them based on the key on the blade file
    // {{ $module_settings->banner_title }}
    public function value()
    {
        return json_decode($this->value);
    }
}
