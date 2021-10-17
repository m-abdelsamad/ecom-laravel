<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Modesl\PromoCode;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_type',
        'price',
        'promo_code_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cartItems(){
        return $this->hasMany(Cart::class);
    }

    public function promoCode(){
        return $this->belonhasgsTo(PromoCode::class);
    }
}
