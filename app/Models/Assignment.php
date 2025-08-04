<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'department_id',
        'due_date',
        'priority', // low, medium, high
        'status', // active, completed, cancelled
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function interns()
    {
        return $this->belongsToMany(User::class, 'assignment_interns', 'assignment_id', 'intern_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
} 