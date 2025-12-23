<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoupleAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'couple_id',
        'key',
        'question_id',
        'answer',
    ];

    public function couple()
    {
        return $this->belongsTo(Couple::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
