<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','phone','jshshir','passport_id','province','region'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
