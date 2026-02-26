<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Agentos',
            'email' => 'agentosroza@gmail.com',
            'password' => '112233',
            'level' => 'admin',
        ]);

        $this->call([
            UserSeeder::class,
            ChatSeeder::class,
        ]);
    }
}
