<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentlyWatching extends Model {
    protected $fillable = ['user_id'];

    // Cast the JSON to an array
    protected $casts = ['currently_watching' => 'array'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
