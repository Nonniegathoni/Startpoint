<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    User::factory()->create([
        'first_name'    => 'Test',
        'middle_name'   => null,            // or whatever
        'last_name'     => 'User',
        'email_address' => 'test@example.com',
        // any other non-nullable fields you need to supply
    ]);
}

    }

