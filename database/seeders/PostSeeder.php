<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * @throws \DateMalformedStringException
     */
    public function run()
    {
        Post::factory()->create([
            "created_by" => 2,
            "text" => "Test",
            "created_at" => \Symfony\Component\Clock\now(),
        ]);
    }
}
