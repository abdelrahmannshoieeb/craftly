<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAddition extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'product_image' => 'array', 
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
