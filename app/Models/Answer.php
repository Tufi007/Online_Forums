<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $primaryKey = 'a_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'answer_text',
        'image',
        'date_time',
        'refrence_links',
        'q_id',
    ];

    // Define the relationship with the Question model
    public function question()
    {
        return $this->belongsTo(Question::class, 'q_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
