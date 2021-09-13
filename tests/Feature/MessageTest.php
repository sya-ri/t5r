<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class MessageTest extends TestCase
{
    public function test_timeline_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('timeline'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_message_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $message = Message::factory()->create();

        $response = $this->actingAs($user)->get("/message/$message->id");

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_message_is_not_found()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/message/-1"); // -1 is an unexpected id (id is unsigned)

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
