<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerOrder;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'percentage',
        'validity',
        'is_valid',
    ];

    public function customerOrder(){
        return $this->hasMany(CustomerOrder::class);
    }
}
