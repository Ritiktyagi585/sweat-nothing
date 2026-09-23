<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => '$2y$12$29qUlBPhqMMrNGUqOZzTRecB1/QsRatwMuQOxnBQXfWFqd/Y1dF66',
            ],
        );
    }
}
