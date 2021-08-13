<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateUserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'phone_number',
     
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
