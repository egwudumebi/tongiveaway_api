<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Payment.php
class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}