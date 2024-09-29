<?php 

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model {

    protected $fillable = ['name', 'description', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function movieStack(){
        return $this->hasMany(Movie::class);
    }

}




?>