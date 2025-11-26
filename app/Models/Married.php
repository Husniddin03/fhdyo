<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Married extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'married'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
