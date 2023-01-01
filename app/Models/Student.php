<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'fname', 'lname', 'sex', 'age', 'grade_id', 'school_id', 'academic_session_id',
        'group_id', 'isProject'
    ];

    public function grade()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
    // public function course()
    // {
    //     return $this->hasMany(Course::class, 'student_id', 'id');
    // }
}
