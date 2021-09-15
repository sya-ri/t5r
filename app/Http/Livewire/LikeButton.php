<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Auth;
use DB;
use Livewire\Component;

class LikeButton extends Component
{
    const Liked = "❤️";
    const Unliked = "🖤";

    public $message;
    public $likeCount;
    public $icon;

    public function render()
    {
        $like = $this->message->getLike(Auth::user());
        $this->icon = ($like)? self::Liked : self::Unliked;
        $this->likeCount = $this->message->likeCount();
        return view('livewire.like-button');
    }

    public function onClick()
    {
        DB::transaction(function () {
            $like = $this->message->getLike(Auth::user());
            if ($like) {
                $like->delete();
            } else {
                $this->message->like(Auth::user());
            }
        });
        $this->render();
    }
}
