<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Camera;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function camera(){
        return $this->hasMany(Camera::class);
    }

}
