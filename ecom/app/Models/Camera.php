<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\Order_detail;
use App\Models\Cart;
use App\Models\Uploads;

class Camera extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'description',
        'price',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cartItems(){
        return $this->hasMany(Cart::class);
    }

    public function uploads(){
        return $this->ownedBy(Uploads::class);
    }
}
