<?php

namespace Database\Seeders;

use App\Models\CommentAnon;
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
        // User::factory(10)->create();

        CommentAnon::create([
            'username' => 'random',
            'content' => 'hallo world',
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Pastebin',
        ]);
    }
}
