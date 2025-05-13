<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['quantity', 'size', 'payment_at', 'user_id', 'shoe_id'];
}
