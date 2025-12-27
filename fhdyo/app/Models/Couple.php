<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

    protected $fillable = [
        'husband',
        'wife',
        'husband_key',
        'wife_key',
        'status',
        'result',
        'user_id',
    ];

    public function husbandData()
    {
        return $this->belongsTo(Human::class, 'husband');
    }

    public function wifeData()
    {
        return $this->belongsTo(Human::class, 'wife');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(CoupleAnswer::class);
    }

    public function results()
    {
        return $this->hasMany(CoupleResult::class);
    }

    public function quizes()
    {
        return $this->hasMany(CoupleQuiz::class);
    }
}
