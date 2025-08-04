<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'department_head', 
        'description', 
        'is_active', 
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }
}