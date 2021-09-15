<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function like(User $user, Message $message): bool
    {
        return $user->id !== $message->user_id;
    }
}
