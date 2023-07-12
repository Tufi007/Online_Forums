<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
