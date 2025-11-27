<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function data()
    {
        return $this->hasOne(DataUser::class);
    }

    public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    public function firstCouples()
    {
        return $this->hasMany(Couple::class, 'first_user_id');
    }

    public function secondCouples()
    {
        return $this->hasMany(Couple::class, 'second_user_id');
    }
}
