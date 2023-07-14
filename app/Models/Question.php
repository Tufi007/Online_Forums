<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;


class Question extends Model
{
    use HasFactory;


    protected $table = 'questions';
    protected $primaryKey = 'q_id';


    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'date_time',
        's_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
{
    return $this->hasMany(Answer::class, 'q_id');
}

public function votes()
{
    return $this->morphMany(Vote::class, 'votable');
}


}
