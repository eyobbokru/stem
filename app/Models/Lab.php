<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'department',
    ];

    public function equipments()
    {
        return $this->hasManyThrough(LabEquipment::class, 
        LaboratoryEquipment::class, 
        'lab_id',
        'id',
        'id',
        'id'
    );
    }

}
