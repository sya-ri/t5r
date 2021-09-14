<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageViewController extends Controller
{
    public function show(Message $message)
    {
        return view('message-view', compact('message'));
    }
}
