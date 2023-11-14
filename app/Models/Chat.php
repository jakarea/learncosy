<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['from', 'to', 'message', 'is_read'];


    public function user()
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }
}
