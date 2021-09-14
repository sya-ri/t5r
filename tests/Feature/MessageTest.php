<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateMessageForm;
use App\Http\Livewire\LikeButton;
use App\Models\Message;
use App\Models\User;
use Livewire\Livewire;
use Str;
use Tests\TestCase;

class MessageTest extends TestCase
{
    public function test_timeline_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $messages = Message::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('timeline'));

        $response->assertOk();
        $response->assertSeeLivewire(CreateMessageForm::class);
        foreach ($messages as $message) {
            $response->assertSee($message->user->name);
            $response->assertSee($message->content);
            $response->assertSeeLivewire(LikeButton::class);
        }
    }

    public function test_message_can_be_created() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $content = Str::random();

        $livewire = Livewire::test(CreateMessageForm::class, ['content' => $content]);
        $livewire->call('onSubmit');

        $message = Message::all()
            ->where('user_id', $user->id)
            ->where('content', $content)
            ->first();
        $this->assertNotNull($message);
    }

    public function test_message_is_trimmed() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $content = ' ' . Str::random() . ' ';

        $livewire = Livewire::test(CreateMessageForm::class, ['content' => $content]);
        $livewire->call('onSubmit');

        $message = Message::all()
            ->where('user_id', $user->id)
            ->where('content', trim($content))
            ->first();
        $this->assertNotNull($message);
    }

    public function test_blank_message_is_not_created() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $content = ' ';

        $livewire = Livewire::test(CreateMessageForm::class, ['content' => $content]);
        $livewire->call('onSubmit');

        $message = Message::all()
            ->where('user_id', $user->id)
            ->where('content', $content)
            ->first();
        $this->assertNull($message);
    }

    public function test_message_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $message = Message::factory()->create();

        $response = $this->actingAs($user)->get(route("message.view", [$message->id]));

        $response->assertOk();
        $response->assertSee($message->user->name);
        $response->assertSee($message->content);
        $response->assertSeeLivewire(LikeButton::class);
    }

    public function test_message_is_not_found()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("message.view", [-1])); // -1 is an unexpected id (id is unsigned)

        $response->assertNotFound();
    }

    public function test_click_button_and_add_like()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $message = Message::factory()->create();

        $livewire = Livewire::test(LikeButton::class, ['message' => $message]);
        $livewire->call('onClick');
        $livewire->assertSet('likeCount', 1);
        $livewire->assertSet('icon', LikeButton::Liked);
    }

    public function test_click_button_and_remove_like()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $message = Message::factory()->create();

        $message->like($user);

        $livewire = Livewire::test(LikeButton::class, ['message' => $message]);
        $livewire->call('onClick');
        $livewire->assertSet('likeCount', 0);
        $livewire->assertSet('icon', LikeButton::Unliked);
    }

    public function test_click_own_message_button_and_ignore_like()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $message = Message::factory(['user_id' => $user->id])->create();

        $livewire = Livewire::test(LikeButton::class, ['message' => $message]);
        $livewire->call('onClick');
        $livewire->assertSet('likeCount', 0);
        $livewire->assertSet('icon', LikeButton::Unliked);
    }
}
