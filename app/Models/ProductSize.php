<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $casts = [
        'size_image' => 'array', 
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
