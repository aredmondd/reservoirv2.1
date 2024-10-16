<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backlog extends Model {
    protected $fillable = ['user_id'];

    // Cast the JSON to an array when
    protected $casts = [ 'backlog' => 'array'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
