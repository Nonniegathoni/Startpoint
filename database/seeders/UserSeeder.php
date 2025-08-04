<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'title' => 'Mr.',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email_address' => 'admin@startpoint.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
            'is_active' => true,
            'created_by' => 'system',
        ]);

        // Create HR Officer
        $hrDepartment = Department::where('name', 'Human Resources')->first();
        User::create([
            'title' => 'Ms.',
            'first_name' => 'HR',
            'last_name' => 'Officer',
            'email_address' => 'hr@startpoint.com',
            'password' => Hash::make('password'),
            'user_type' => 'hr_officer',
            'department_id' => $hrDepartment->id,
            'is_active' => true,
            'created_by' => 'system',
        ]);

        // Create Supervisor
        $itDepartment = Department::where('name', 'Information Technology')->first();
        User::create([
            'title' => 'Mr.',
            'first_name' => 'IT',
            'last_name' => 'Supervisor',
            'email_address' => 'supervisor@startpoint.com',
            'password' => Hash::make('password'),
            'user_type' => 'supervisor',
            'department_id' => $itDepartment->id,
            'is_active' => true,
            'created_by' => 'system',
        ]);

        // Create sample applicants
        User::create([
            'title' => 'Mr.',
            'first_name' => 'John',
            'last_name' => 'Student',
            'email_address' => 'student1@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'applicant',
            'cohort' => '2024 Spring',
            'phone_number' => '+254700000001',
            'is_active' => true,
            'created_by' => 'system',
        ]);

        User::create([
            'title' => 'Ms.',
            'first_name' => 'Jane',
            'last_name' => 'Intern',
            'email_address' => 'student2@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'applicant',
            'cohort' => '2024 Spring',
            'phone_number' => '+254700000002',
            'is_active' => true,
            'created_by' => 'system',
        ]);
    }
} 