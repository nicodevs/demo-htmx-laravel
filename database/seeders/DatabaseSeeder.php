<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        collect([
            'This is great',
            'I like it',
            'So cool!',
            'I love it',
            'Great!',
            'I love it too!',
        ])->each(fn ($text) => Comment::factory()->create(['text' => $text]));

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
