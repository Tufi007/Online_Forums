<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment_text', 'user_id', 'q_id', 'a_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'q_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'a_id');
    }
}
