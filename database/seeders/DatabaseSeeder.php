<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            OpportunityTypeSeeder::class,
            CompensationTypeSeeder::class,
            TitleSeeder::class,
            CohortSeeder::class,
            UserSeeder::class,
        ]);
    }
}

