<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_equipment_id',
        'description',
        'number',
        'status'
    ];

}
