<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch_schedule;
use App\Models\Branch_shooting_session;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function branch_schedule(){
        return $this->hasMany(Branch_schedule::class);
    }

    public function branchShootingSession(){
        return $this->hasMany(Branch_shooting_session::class);
    }
}
