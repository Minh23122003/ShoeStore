<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = ['name', 'information', 'quantity', 'price', 'image', 'note', 'category_id'];
}
