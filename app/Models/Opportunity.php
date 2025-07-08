<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'opportunity_type',
        'compensation_type',
        'compensation_amount',
        'compensation_currency',
        'expiry_date',
        'opportunity_description',
        'core_competencies',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'compensation_amount' => 'decimal:2',
    ];

    public function getFormattedAmountAttribute()
    {
        if ($this->compensation_amount > 0) {
            return 'KES ' . number_format($this->compensation_amount, 0, '.', ',');
        }
        return $this->compensation_type;
    }
}
