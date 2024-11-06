<?php 

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model {
    protected $fillable = ['name', 'description', 'user_id', 'isPrivate'];

    // Cast the JSON to an array
    protected $casts = ['content' => 'array'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * add content to a user's stack
     * 
     * @access public
     * @author Aiden Redmond
     * @param String $content_id: ID of the content being added to stack
     * @param String $content_type: Type of content being added to stack
     */
    public function add_to_stack(String $content_id, String $content_type) {
        // check if there is content inside the stack. if there isn't, make an empty array
        $stack_content = $this->content ?? [];

        // check if the content being added is already in the stack
        $content_in_stack = in_array($content_id, array_column($stack_content, 'id'));

        /**
         * if the content is not inside the stack, add it & save the stack.
         * if the content is already inside the stack, throw an error.
         */
        if (!$content_in_stack) {
            $stack_content[] = [
                'id'          => $content_id,
                'time'        => now(),
                'contentType' => $content_type,
                'liked'       => false
            ];

            $this->content = $stack_content;
            $this->save();
        } else {
            return redirect()->back()->with('error', 'this content is already in this stack');
        }
    }

}

// EOF