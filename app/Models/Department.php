<?php
// app/Models/Department.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'department_head', 'description', 'is_active', 'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'department', 'name');
    }
}