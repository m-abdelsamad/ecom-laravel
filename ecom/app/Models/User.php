<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CustomerOrder;
use App\Models\Cart;
use App\Models\Uploads;
use App\Models\User_address;
use App\Models\User_payment;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order(){
        return $this->hasMany(CustomerOrder::class);
    }

    public function uploads(){
        return $this->hasMany(Uploads::class);
    }

    public function user_address(){
        return $this->hasMany(User_address::class);
    }

    public function user_payment(){
        return $this->hasMany(User_payment::class);
    }
    
}
