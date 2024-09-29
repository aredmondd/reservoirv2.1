<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'poster_path', 'description', 'stack_id'];

    public function stack() {
        return $this->belongsTo(Stack::class);
    }
}
