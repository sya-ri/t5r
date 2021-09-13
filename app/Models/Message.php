<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likeCount()
    {
        return $this->hasMany(Like::class)->count();
    }

    public function getLike($user)
    {
        return $this->hasMany(Like::class)->firstWhere('user_id', $user->id);
    }

    public function canLike($user)
    {
        return $user->id !== $this->user_id;
    }

    public function like($user)
    {
        if ($this->canLike($user)) {
            Like::create(['user_id' => $user->id, 'message_id' => $this->id]);
        }
    }
}
