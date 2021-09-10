<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageViewController extends Controller
{
    public function show($id)
    {
        $message = Message::find($id);

        return view('message-view', compact('message'));
    }
}
