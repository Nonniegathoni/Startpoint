<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id',
        'report_type', // weekly, monthly
        'report_period_start',
        'report_period_end',
        'tasks_completed',
        'challenges_faced',
        'lessons_learned',
        'next_week_goals',
        'supervisor_feedback',
        'rating', // 1-5 scale
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'report_period_start' => 'date',
        'report_period_end' => 'date',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function intern()
    {
        return $this->belongsTo(User::class, 'intern_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
} 