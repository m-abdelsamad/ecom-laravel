<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Branch;

class Branch_shooting_session extends Model
{
    use HasFactory;

    protected $fillable = [
        "branch_id",
        // 'branch_schedule_id',
        'date',
        'duration',
        'available',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
