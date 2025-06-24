<?php
// app/Models/Opportunity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $fillable = [
        'title', 'department', 'opportunity_type', 'opportunity_description',
        'core_competencies', 'compensation_type', 'compensation_currency',
        'compensation_amount', 'expiry_date', 'is_active', 'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'compensation_amount' => 'float',
        'expiry_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'opportunity_user')
                    ->withPivot('is_active')
                    ->withTimestamps();
    }

    public function departmentRelation()
    {
        return $this->belongsTo(Department::class, 'department', 'name');
    }

    public function opportunityTypeRelation()
    {
        return $this->belongsTo(OpportunityType::class, 'opportunity_type', 'type');
    }

    public function compensationTypeRelation()
    {
        return $this->belongsTo(CompensationType::class, 'compensation_type', 'type');
    }
}