<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::truncate();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => "12345",
        ]);
        $this->call([
            PropertiesModelSeeder::class
        ]);
    }
}
