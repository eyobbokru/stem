<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Course;
use App\Models\AcademicSessionCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AcademicSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'academicYear',
        'startingDate',
        'endingDate',
        'type',
        'active'


    ];

    public function section()
    {
        return $this->hasMany(Group::class, 'academic_session_id', 'id');
    }

    // public function courses()
    // {
    //     return $this->hasMany(Course::class,AcademicSessionCourse::class, 'academic_session_id', 'id','id','course_id');
    // }

    public function projects()
    {
        return $this->hasMany(Project::class, 'academic_session_id', 'id');
    }


    /**
     * The roles that belong to the course.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
        // return $this->hasManyThrough(Course::class, AcademicSessionCourse::class, 'course_id', 'id', 'id', 'academic_session_id');
    }

   
}
