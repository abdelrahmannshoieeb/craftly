<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    public function coupons()
    {
        return $this->belongsTo(Coupon::class);
    }


    public function getDiscountMultiplierAttribute()
{
    return $this->discount_percentage / 100;
}

}
