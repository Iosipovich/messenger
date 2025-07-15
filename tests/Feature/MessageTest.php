<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_send_message_to_another_user()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $this->actingAs($sender);

        $response = $this->post(route('chat', $receiver->id), [
            'body' => 'Привет, это тестовое сообщение!',
        ]);

        $response->assertRedirect(route('chat', $receiver->id));

        $this->assertDatabaseHas('messages', [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'body' => 'Привет, это тестовое сообщение!',
        ]);
    }
}
