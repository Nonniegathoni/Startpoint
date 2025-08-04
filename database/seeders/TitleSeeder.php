<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            [
                'name' => 'Mr.',
                'description' => 'Mister',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Ms.',
                'description' => 'Miss',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Mrs.',
                'description' => 'Missus',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Dr.',
                'description' => 'Doctor',
                'is_active' => true,
                'created_by' => 'system',
            ],
            [
                'name' => 'Prof.',
                'description' => 'Professor',
                'is_active' => true,
                'created_by' => 'system',
            ],
        ];

        foreach ($titles as $title) {
            Title::create($title);
        }
    }
} 