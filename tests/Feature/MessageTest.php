<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class MessageTest extends TestCase
{
    public function test_timeline_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $messages = Message::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('timeline'));

        $response->assertOk();
        foreach ($messages as $message) {
            $response->assertSee($message->user->name);
            $response->assertSee($message->content);
        }
    }

    public function test_message_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $message = Message::factory()->create();

        $response = $this->actingAs($user)->get("/message/$message->id");

        $response->assertOk();
        $response->assertSee($message->user->name);
        $response->assertSee($message->content);
    }

    public function test_message_is_not_found()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/message/-1"); // -1 is an unexpected id (id is unsigned)

        $response->assertNotFound();
    }
}
