<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'detail', 'image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}