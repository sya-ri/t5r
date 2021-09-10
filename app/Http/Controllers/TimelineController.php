<?php

namespace App\Http\Controllers;

use App\Models\Message;

class TimelineController extends Controller
{
    public function show()
    {
        $messages = Message::all([
            'id',
            'created_at',
            'user_id', // user
            'content',
        ])->sortDesc();

        return view('timeline', compact('messages'));
    }
}
