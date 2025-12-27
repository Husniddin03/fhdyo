<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoupleQuiz extends Model
{
    use HasFactory;

    protected $table = 'couple_quizes';

    protected $fillable = [
        'couple_id',
        'category_id',
        'question_id'
    ];

    public function couple()
    {
        return $this->belongsTo(Couple::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
