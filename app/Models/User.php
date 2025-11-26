<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'couple', 'gender'
    ];

    protected $hidden = [
        'password',
    ];

    public function dataUser()
    {
        return $this->hasOne(DataUser::class);
    }

    public function unMarried()
    {
        return $this->hasOne(UnMarried::class);
    }

    public function married()
    {
        return $this->hasOne(Married::class);
    }

    public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
