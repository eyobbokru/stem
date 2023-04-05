<?php

namespace App\Models;

use App\Models\Course;
use App\Models\AcademicSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSessionCourse extends Model
{
    protected $table = 'academic_session_course';

    use HasFactory;
    protected $fillable = [
        'academic_session_id',
        'course_id'
    ];

 

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
