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
        // aiden account
        $attributes = [
            'name' => 'aiden',
            'username' => 'aredmond',
            'email' => 'aiden@gmail.com',
            'password' => 'password',
            'bio' => 'the UI guy',
            'profile_picture' => 'profile_pictures/redmond.jpg',
            'pending_friend_requests' => [],
            'current_friends' => []
        ];

        $user = User::create($attributes);
        $user->watchlist()->create();
        $user->history()->create();
        $user->currentlyWatching()->create();
        $user->stack()->create([
            'name'        => 'all i know is pain.',
            'description' => 'all i know is pain',
            'content'     => [
                [
                    'id'          => '12477',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '15584',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '423',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '105248',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'tv',
                    'liked'       => false
                ],
                [
                    'id'          => '424',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ]
            ],
            'isPrivate' => false
        ]);        

        // brandon account
        $attributes = [
            'name' => 'brandon',
            'username' => 'bwilson',
            'email' => 'brandon@gmail.com',
            'password' => 'password',
            'bio' => 'the database guy',
            'profile_picture' => 'profile_pictures/wilson.jpg',
            'pending_friend_requests' => [],
            'current_friends' => [],
        ];

        $user = User::create($attributes);
        $user->watchlist()->create();
        $user->history()->create();
        $user->currentlyWatching()->create();
        $user->stack()->create([
            'name'        => 'Best Anime of 2024',
            'description' => 'THE best anime of 2024',
            'content'     => [
                [
                    'id'          => '37854',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'tv',
                    'liked'       => false
                ],
                [
                    'id'          => '240411',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'tv',
                    'liked'       => false
                ],
                [
                    'id'          => '127532',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'tv',
                    'liked'       => false
                ],
                [
                    'id'          => '209867',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'tv',
                    'liked'       => false
                ],
                [
                    'id'          => '1244492',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ]
            ],
            'isPrivate' => false
        ]); 

        // axel account
        $attributes = [
            'name' => 'axel',
            'username' => 'abeaver',
            'email' => 'axel@gmail.com',
            'password' => 'password',
            'bio' => 'the AI guy',
            'profile_picture' => 'profile_pictures/beaver.jpg',
            'pending_friend_requests' => [],
            'current_friends' => [],
        ];

        $user = User::create($attributes);
        $user->watchlist()->create();
        $user->history()->create();
        $user->currentlyWatching()->create();
        $user->stack()->create([
            'name'        => 'Best Horror Movies',
            'description' => 'The best horror movies of ALL TIME',
            'content'     => [
                [
                    'id'          => '30497',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '9552',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '274',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '694',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ],
                [
                    'id'          => '348',
                    'time'        => '2024-10-27T17:30:13.239248Z',
                    'contentType' => 'movie',
                    'liked'       => false
                ]
            ],
            'isPrivate' => false
        ]); 
    }
}
