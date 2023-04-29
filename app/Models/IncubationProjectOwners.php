<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncubationProjectOwners extends Model
{
    use HasFactory;
    protected $fillable = [
        'incubation_id',
        'incubation_owners_id',
    ];
}
