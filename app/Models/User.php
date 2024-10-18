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

    public function getProfilePictureUrl(){
        return $this->profile_picture ? Storage::url($this->profile_picture) : 'public/images/default.png';
    }
}

