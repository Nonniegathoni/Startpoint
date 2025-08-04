<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Information Technology',
                'department_head' => 'John Doe',
                'description' => 'Handles all IT-related operations and development',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Human Resources',
                'department_head' => 'Jane Smith',
                'description' => 'Manages human resources and recruitment',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Finance',
                'department_head' => 'Mike Johnson',
                'description' => 'Handles financial operations and accounting',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Marketing',
                'department_head' => 'Sarah Wilson',
                'description' => 'Manages marketing and communications',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Operations',
                'department_head' => 'David Brown',
                'description' => 'Handles day-to-day operations',
                'is_active' => true,
                'created_by' => 'system',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
} 