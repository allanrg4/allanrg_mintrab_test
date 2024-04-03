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
        $this->call([RoleSeeder::class]);

        User::factory()->create([
            'name' => 'Technical User',
            'email' => 'tech@example.com',
            'password' => bcrypt('password'),
        ])->assignRole('technical');

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'regular@example.com',
            'password' => bcrypt('password'),
        ])->assignRole('regular');
    }
}
