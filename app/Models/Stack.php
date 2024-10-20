<?php 

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model {
    protected $fillable = ['name', 'description', 'user_id'];

    // Cast the JSON to an array
    protected $casts = [ 'content' => 'array'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function addToStack($contentId, $contentType) {
        $content = $this->content ?? [];

        if (!in_array($contentId, array_column($content, 'id'))) {
            $content[] = [
                'id' => $contentId,
                'time' => now(),
                'contentType' => $contentType,
                'liked' => false
            ];

            $this->content = $content;
            $this->save();
        } else {
            dump("Content ID {$contentId} is already in the stack.");
        }
    }

}
?>