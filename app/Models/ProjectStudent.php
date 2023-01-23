<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectStudent extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'student_id'];

    public function student()
    {
        return $this->hasMany(Student::class, 'student_id');
    }
}
