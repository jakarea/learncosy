<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'course_id',
        'message',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function scopeLastMessagePerUser($query)
    {
        return $query->whereIn('id', function ($subquery) {
            $subquery->selectRaw('MAX(id)')
                ->from('messages')
                ->groupBy('user_id','receiver_id');
        });
    }
}