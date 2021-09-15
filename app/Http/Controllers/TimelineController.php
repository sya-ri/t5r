<?php

namespace App\Http\Controllers;

use App\Models\Message;

class TimelineController extends Controller
{
    public function show()
    {
        // TODO: offsetやlimitの指定が将来的に必要になりそう（ページングやレイジーロードがの検討）
        $messages = Message::all([
            'id',
            'created_at',
            'user_id', // user
            'content',
        ])->sortByDesc('created_at');

        return view('timeline', compact('messages'));
    }
}
