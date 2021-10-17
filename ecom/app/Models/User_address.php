<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;

class User_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
    ];


    public function user(){
        return $this->ownedBy(User::class);
    }

    public function address(){
        return $this->ownedBy(Address::class);
    }
    
}
