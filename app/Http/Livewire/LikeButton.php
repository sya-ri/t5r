<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeButton extends Component
{
    public $message;
    public $likes;
    public $icon;
    private $isLike; // いいねしているか TODO いいね機能実装時に削除

    public function render()
    {
        $this->icon = $this->isLike? "❤️" : "🖤️";
        $this->likes = $this->message->likes();
        return view('livewire.like-button');
    }

    public function onClick()
    {
        $this->isLike = !$this->isLike;
        $this->render();
    }
}
