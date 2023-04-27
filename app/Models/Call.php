<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;
    protected $with = ['coe'];
    protected $fillable = [
        'name',
        'end_date',
        'coes_id'
    ];

    public function coe()
    {
        return $this->hasOne(CoE::class, 'id', 'coes_id');
    }
}
