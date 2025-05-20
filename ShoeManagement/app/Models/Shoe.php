<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = ['name', 'information', 'quantity', 'price', 'image', 'note', 'category_id'];
}
