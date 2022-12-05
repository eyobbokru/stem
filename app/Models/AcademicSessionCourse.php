<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSessionCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'academic_session_id',
        'course_id'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'id', 'course_id');
    }

    //
}
