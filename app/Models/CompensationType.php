<?php
// app/Models/CompensationType.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompensationType extends Model
{
    protected $fillable = [
        'type', 'description', 'is_active', 'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'compensation_type', 'type');
    }
}