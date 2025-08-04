<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'evaluator_id',
        'evaluation_type', // interim, final
        'score',
        'feedback',
        'evaluated_at',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'evaluated_at' => 'datetime',
        'score' => 'integer',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
} 