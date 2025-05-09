<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Carbon\Factory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Employer::factory()->create([
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'logo' => asset('resources/images/logo.png')
        ]);

        $this->call(JobSeeder::class);

        $this->call(RoleSeeder::class);
    }
}
