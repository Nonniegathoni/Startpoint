<?php

namespace Database\Seeders;

use App\Models\CompensationType;
use Illuminate\Database\Seeder;

class CompensationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'type' => 'Paid',
                'description' => 'Paid compensation',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Unpaid',
                'description' => 'Unpaid opportunity',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Stipend',
                'description' => 'Stipend-based compensation',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'type' => 'Commission',
                'description' => 'Commission-based compensation',
                'is_active' => true,
                'created_by' => 'system',
            ],
        ];

        foreach ($types as $type) {
            CompensationType::create($type);
        }
    }
} 