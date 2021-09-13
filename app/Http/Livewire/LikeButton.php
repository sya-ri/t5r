<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Auth;
use Livewire\Component;

class LikeButton extends Component
{
    public $message;
    public $likeCount;
    public $icon;

    public function render()
    {
        $like = $this->message->getLike(Auth::user());
        $this->icon = ($like)? "❤️" : "🖤️";
        $this->likeCount = $this->message->likeCount();
        return view('livewire.like-button');
    }

    public function onClick()
    {
        $like = $this->message->getLike(Auth::user());
        if ($like) {
            $like->delete();
        } else {
            $this->message->like(Auth::user());
        }
        $this->render();
    }
}
