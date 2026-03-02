<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create your test user (admin)
        $main = User::firstOrCreate(
            ['email' => 'agentosroza@gmail.com'],
            [
                'name' => 'Developer',
                'password' => Hash::make('112233'),
                'email_verified_at' => now(),
                'level' => 'admin',
            ]
        );

        // Create additional test users for chat interactions
        $users = [
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'password' => Hash::make('112233'),
                'email_verified_at' => now(),
                'level' => 'admin',
            ],
            [
                'name' => 'Dara Brown',
                'email' => 'dara@example.com',
                'password' => Hash::make('112233'),
                'email_verified_at' => now(),
                'level' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        $this->command->info('Users seeded successfully!');
    }
}
