<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

 
    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'additions' => 'array',
        'gallery' => 'array', 
        'images' => 'array', 
        'tags' => 'array', 
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_products');
    }


    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products');
    }


    public function additions()
    {
        return $this->belongsToMany(Addition::class, 'addition_products');
    }


    public function Cartitems()
    {
        return $this->hasMany(CartItem::class);
    }


    
    public function ProductAddition()
    {
        return $this->hasMany(ProductAddition::class);
    }
    public function ProductColor()
    {
        return $this->hasMany(ProductColor::class);
    }
    public function ProductSize()
    {
        return $this->hasMany(ProductSize::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_products');
    }
}
