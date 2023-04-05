<?php

namespace App\Models;

use App\Models\Student;
use App\Models\ProjectStudent;
use App\Models\ProjectProgress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'result'];

    protected $with = ['students','progress'];


    public function progress()
    {
        return $this->hasMany(ProjectProgress::class, 'project_id', 'id');
    }

    public function projectStudents()
    {
        return $this->hasMany(ProjectStudent::class, 'project_id', 'id');
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, ProjectStudent::class, 'project_id', 'id', 'id', 'student_id');
    }
}
