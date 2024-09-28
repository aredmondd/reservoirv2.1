<?php 

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model {

    protected $fillable = ['name', 'description'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}




?>