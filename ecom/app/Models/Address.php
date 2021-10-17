<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_address;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'city_name',
        'street_name',
        'building_number',
    ];

    public function user_address(){
        return $this->hasMany(User_address::class);
    }

}
