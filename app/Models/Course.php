<?php

namespace App\Models;

use App\Models\User;
use App\Models\AcademicSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'totalLecPerWeek',
        'totalLabPerWeek',
        'responsible_lec_id',
        'responsible_lab_id',
    ];

    public function lecturer()
    {
        return $this->hasOne(User::class, 'id', 'responsible_lec_id');
    }

    /**
     * The users that belong to the role.
     */
    public function academicSessions(): BelongsToMany
    {
        return $this->belongsToMany(AcademicSession::class);
    }
}
