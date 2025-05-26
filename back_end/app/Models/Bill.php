<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    protected $fillable = ['quantity', 'size', 'payment_at', 'user_id', 'shoe_id'];
}
