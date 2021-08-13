<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPasswordOtps extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'otp',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
