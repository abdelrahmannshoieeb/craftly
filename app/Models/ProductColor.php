<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'color_image' => 'array', 
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
