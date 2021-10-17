<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_payment;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'card_holder',
        'expiration_date',
        'cvc_code',
    ];

    public function user_payment(){
        return $this->hasMany(User_payment::class);
    }
}
