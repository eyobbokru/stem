<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'totalLecPerWeek',
        'totalLabPerWeek',
        'responsible_lec_id',
        'responsible_lab_id',
    ];

    public function lecturer()
    {
        return $this->hasOne(User::class, 'id', 'responsible_lec_id');
    }
}
