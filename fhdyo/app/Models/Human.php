<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Human extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthday',
        'phone',
        'jshshir',
        'passport_id',
        'province',
        'region',
    ];

    public function husbandCouples()
    {
        return $this->hasMany(Couple::class, 'husband');
    }

    public function wifeCouples()
    {
        return $this->hasMany(Couple::class, 'wife');
    }
}
