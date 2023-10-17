<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';


    protected $primaryKey = 'id';

    protected $fillable = [
        's_id',
        'title',
        'description',
        'date_time',
        'subject_code',
    ];

    public function questions()
{
    return $this->belongsToMany(Question::class);
}

}
