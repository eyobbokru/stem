<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncubationProjectProgress extends Model
{
    use HasFactory;

    protected $fillable = ['incubation_id', 'progressReport', 'image_video'];

}
