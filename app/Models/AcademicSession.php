<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'academicYear',
        'startingDate',
        'endingDate',
        'type'


    ];

    public function section()
    {
        return $this->hasMany(Group::class, 'academic_session_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(AcademicSessionCourse::class, 'academic_session_id', 'id');
    }
}
