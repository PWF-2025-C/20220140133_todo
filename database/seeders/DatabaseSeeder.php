<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Todo;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\Category::insert([
            ['name' => 'Category A'],
            ['name' => 'Category B'],
            ['name' => 'Category C'],
        ]);

        User::firstOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        User::factory(100) -> create();
        Todo::factory(500) -> create();
    }
}
