<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'opportunity_id',
        'status', // pending, shortlisted, approved, rejected, withdrawn
        'cover_letter',
        'resume_path',
        'additional_notes',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
} 