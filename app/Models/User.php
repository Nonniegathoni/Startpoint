<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'cohort_id',
        'email_address',
        'password',
        'is_active',
        'user_type', // admin, applicant, supervisor, hr_officer
        'department_id',
        'date_of_birth',
        'bio',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'date_of_birth' => 'date',
        ];
    }

    public function getAuthIdentifierName()
    {
        return 'email_address';
    }

    public function routeNotificationForMail()
    {
        return $this->email_address;
    }

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }

    public function supervisedInterns()
    {
        return $this->hasMany(Intern::class, 'supervisor_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class, 'intern_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_interns', 'intern_id', 'assignment_id');
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isApplicant()
    {
        return $this->user_type === 'applicant';
    }

    public function isSupervisor()
    {
        return $this->user_type === 'supervisor';
    }

    public function isHrOfficer()
    {
        return $this->user_type === 'hr_officer';
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
    }

    // Accessor for email (to maintain compatibility)
    public function getEmailAttribute()
    {
        return $this->email_address;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email_address'] = $value;
    }
}