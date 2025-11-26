<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_answers_id', 'result'
    ];

    public function answer()
    {
        return $this->belongsTo(UserAnswer::class, 'user_answers_id');
    }
}
