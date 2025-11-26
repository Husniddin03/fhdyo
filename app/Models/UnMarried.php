<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnMarried extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'un_married'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
