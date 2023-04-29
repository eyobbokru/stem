<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incubation extends Model
{
    use HasFactory;
// name will have incubation owners 
    protected $fillable = ['name', 'description', 'stage'];

    protected $with = ['progress'];

    public function progress()
    {
        return $this->hasMany(IncubationProjectProgress::class, 'incubation_id', 'id');
    }

   

    public function owners()
    {
        return $this->hasManyThrough(IncubationOwners::class, IncubationProjectOwners::class, 'incubation_id', 'id', 'id', 'incubation_owners_id');
    }
    

}
