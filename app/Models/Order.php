<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function cartItem()
    {
        return $this->cart->cartItems(); 
    }

    public function coupons()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getTotalStatusAttribute()
    {
        return $this->attributes['total_status'] === 'paid';
    }
    public function getDepositStatusAttribute()
    {
        return $this->attributes['deposit_status'] === 'paid';
    }
    
    public function getTotalPriceAttribute()
    {
        $cartItems = $this->cartItem; 
        $customPrice = $this->customization_price ?? 0; 
    
        $total = $cartItems->sum(function ($cartItem) {
            $product = $cartItem->product;
            $colorPrice = $cartItem->color_price ?? 0;
            $additionPrice = $cartItem->addition_price ?? 0;
            $sizePrice = $cartItem->size_price ?? 0;
    
            return $product->base_price + $colorPrice + $additionPrice + $sizePrice;
        });
    
        $total += $customPrice;
    
        $totalWithDiscounts = $cartItems->sum(function ($cartItem) {
            $product = $cartItem->product;
            $colorPrice = $cartItem->color_price ?? 0;
            $additionPrice = $cartItem->addition_price ?? 0;
            $sizePrice = $cartItem->size_price ?? 0;
    
            $itemTotal = $product->base_price + $colorPrice + $additionPrice + $sizePrice;
            $discount = $product->discount_value ?? 0; 
            $itemTotal -= ($itemTotal * ($discount / 100));
    
            return $itemTotal;
        });
    
        $totalWithDiscounts += $customPrice;
    
        $coupon = $this->coupon; 
        if ($coupon) {
            $totalWithDiscounts *= (1 - ($coupon->discount_multiplier ?? 0));
        }
    
        $totalWithDiscounts = max($totalWithDiscounts, 0);
    
        return number_format($totalWithDiscounts, 2); 
    }
}
