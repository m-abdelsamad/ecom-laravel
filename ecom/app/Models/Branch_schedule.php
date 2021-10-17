<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class Branch_schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'opening_hour',
        'closing_hour',
        'date',
        'date_type',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
