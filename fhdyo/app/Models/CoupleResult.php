<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoupleResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'couple_id',
        'category_id',
        'percent',
    ];

    public function couple()
    {
        return $this->belongsTo(Couple::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
