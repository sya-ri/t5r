<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageViewController extends Controller
{
    public function show($id)
    {
        $message = Message::find($id);

        if ($message) {
            return view('message-view', compact('message'));
        }

        abort(404, 'Message Not Found');
    }
}
