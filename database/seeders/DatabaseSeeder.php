<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $attributes = [
            'name' => 'aiden',
            'username' => 'aiden',
            'email' => 'aiden@gmail.com',
            'password' => 'password',
        ];

        $user = User::create($attributes);

        $user->watchlist()->create();
        $user->history()->create();

        $attributes = [
            'name' => 'brandon',
            'username' => 'brandon',
            'email' => 'brandon@gmail.com',
            'password' => 'password',
        ];

        $user = User::create($attributes);

        $user->watchlist()->create();
        $user->history()->create();
    }
}
