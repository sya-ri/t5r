<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Auth;
use Livewire\Component;

class CreateMessageForm extends Component
{
    const MaxLength = 255;

    public $content = '';

    public function render()
    {
        return view('livewire.create-message-form');
    }

    public function onSubmit()
    {
        $this->content = trim($this->content);
        if ($this->content && strlen($this->content) <= self::MaxLength) {
            Message::create(['user_id' => Auth::user()->id, 'content' => $this->content]);
            redirect(request()->header('Referer')); // reload page
        }
    }
}
