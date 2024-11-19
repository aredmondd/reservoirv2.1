<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'profile_picture',
        'is_private',
        'pending_friend_requests',
        'current_friends',
    ];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'pending_friend_requests' => 'array',
            'current_friends' => 'array',
            'profile_content_favorites' => 'array',
            'recommended_content' => 'array',
        ];
    }

    public function stack() {
        return $this->hasMany(Stack::class);
    }

    public function watchlist() {
        return $this->hasOne(Watchlist::class);
    }

    public function history() {
        return $this->hasOne(History::class);
    }

    public function currentlyWatching() {
        return $this->hasOne(currentlyWatching::class);
    }

    public function getProfilePictureUrl(){
        return $this->profile_picture ? Storage::url($this->profile_picture) : 'public/images/default.png';
    }

    public function addFriendRequest(int $requestID){

        $friendRequest = $this->pending_friend_requests ?? [];

        $alreadyRequested = in_array($requestID, array_column($friendRequest, 'id'));


        if(!$alreadyRequested){
            $friendRequest[] = [
                'id' => $requestID,
                'time' => now(),
            ];

            $this->pending_friend_requests = $friendRequest;
            $this->save(); 
            return true;
        } else {
            return false;
        }
    }
}

