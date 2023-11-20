<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id','group_id', 'message','file','file_extension','type', 'is_read'];

    public function user()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function scopeLastMessagePerUser($query)
    {
        return $query->whereIn('id', function ($subquery) {
            $subquery->selectRaw('MAX(id)')
                ->from('chats')
                ->groupBy('sender_id','receiver_id');
        });
    }
}
