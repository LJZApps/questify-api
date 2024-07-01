<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     */
    public function run(): void
    {
        Post::factory()->create([
            "created_by" => 1,
            "text" => "Test",
        ]);
    }
}
