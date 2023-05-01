<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabEquipment extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'quantity', 'si_unit'];


}
