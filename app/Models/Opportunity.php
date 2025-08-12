<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'opportunity_description',
        'core_competencies',
        'compensation_currency',
        'compensation_amount',
        'expiry_date',
        'is_active',
        'department_id',
        'opportunity_type_id',
        'compensation_type_id',
        'created_by',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'compensation_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function opportunityType()
    {
        return $this->belongsTo(OpportunityType::class);
    }

    public function compensationType()
    {
        return $this->belongsTo(CompensationType::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class, 'opportunity_user', 'opportunity_id', 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Helper methods
    public function getFormattedAmountAttribute()
    {
        if ($this->compensation_amount > 0) {
            return $this->compensation_currency . ' ' . number_format($this->compensation_amount, 0, '.', ',');
        }
        return $this->compensationType->type ?? 'Unpaid';
    }

    public function getStatusAttribute()
    {
        if ($this->expiry_date && $this->expiry_date->isPast()) {
            return 'Expired';
        } elseif ($this->expiry_date && $this->expiry_date->diffInDays(now()) <= 7) {
            return 'Expiring Soon';
        } else {
            return 'Active';
        }
    }
}
