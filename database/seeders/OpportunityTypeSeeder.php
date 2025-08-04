<?php

namespace Database\Seeders;

use App\Models\OpportunityType;
use Illuminate\Database\Seeder;

class OpportunityTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'type' => 'Internship',
                'description' => 'Student internship opportunities',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Full-time',
                'description' => 'Full-time employment opportunities',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Part-time',
                'description' => 'Part-time employment opportunities',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Contract',
                'description' => 'Contract-based opportunities',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Volunteer',
                'description' => 'Volunteer opportunities',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Research',
                'description' => 'Research opportunities',
                'is_active' => true,
                'created_by' => 'system',
            ],
        ];

        foreach ($types as $type) {
            OpportunityType::create($type);
        }
    }
} 