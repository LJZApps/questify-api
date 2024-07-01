<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Leon Zapke',
            'email' => "lnzpk.dev@gmail.com",
            'password' => bcrypt('Leon.2302'),
        ]);
    }
}
