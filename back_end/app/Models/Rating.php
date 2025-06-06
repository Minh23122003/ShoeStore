<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    protected $fillable = ['star', 'content', 'user_id', 'shoe_id'];
}
