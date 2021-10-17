<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Camera;
use App\Models\CustomerOrder;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_order_id',
        'camera_id',
        'quantity',
    ];


    public function customerOrder(){
        return $this->belongsTo(CustomerOrder::class);
    }

    public function Camera(){
        return $this->belongsTo(Camera::class);
    }


    


}
