<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'supervisor_id',
        'start_date',
        'end_date',
        'status', // active, completed, terminated
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'intern_id');
    }

    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class, 'intern_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_interns', 'intern_id', 'assignment_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'intern_id');
    }
} 