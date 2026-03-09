<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting User seeding...');

        User::factory()->withRole('admin')->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
        ]);

        User::factory()->withRole('supervisor')->create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@gmail.com',
        ]);

        User::factory()->withRole('user')->create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
        ]);

        
        $this->command->info('User seeding completed successfully.');
    }
}