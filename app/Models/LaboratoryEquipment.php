<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryEquipment extends Model
{
    use HasFactory;

    protected $fillable = ['lab_id', 'lab_equipment_id', 'quantity', 'number', 'status'];

    public function laboratory()
    {
        return $this->hasOne(Lab::class, 'id', 'lab_id');
    }
    public function equipment()
    {
        return $this->hasOne(LabEquipment::class, 'id', 'lab_equipment_id');
    }


}
