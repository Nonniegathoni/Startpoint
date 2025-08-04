<?php

namespace Database\Seeders;

use App\Models\Cohort;
use Illuminate\Database\Seeder;

class CohortSeeder extends Seeder
{
    public function run(): void
    {
        $cohorts = [
            [
                'name' => '2024 Spring',
                'code_name' => 'SPR24',
                'president' => 'John Smith',
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => '2024 Summer',
                'code_name' => 'SUM24',
                'president' => 'Jane Doe',
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-31',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => '2024 Fall',
                'code_name' => 'FAL24',
                'president' => 'Mike Johnson',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-15',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => '2025 Spring',
                'code_name' => 'SPR25',
                'president' => 'Sarah Wilson',
                'start_date' => '2025-01-15',
                'end_date' => '2025-05-15',
                'is_active' => true,
                'created_by' => 'system',
            ],
        ];

        foreach ($cohorts as $cohort) {
            Cohort::create($cohort);
        }
    }
} 