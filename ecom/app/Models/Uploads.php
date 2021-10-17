<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Camera;

class Uploads extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'camera_id',
        'description',
        'path',
    ];

    public function user(){
        return $this->ownedBy(User::class);
    }

    public function camera(){
        return $this->hasOne(Camera::class);
    }
}
