<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;

class Shoe extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = ['name', 'information', 'quantity', 'price', 'image', 'note', 'category_id'];
    protected $appends = ['remaining_quantity'];

    public function getRemainingQuantityAttribute()
    {
        $sold = Bill::where('shoe_id', $this->id)->sum('quantity');

        return $this->quantity - $sold;
    }
}
