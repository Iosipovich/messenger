<?php
namespace App\Services;

use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;

class MessageService
{
    public function sendMessage(User $from, User $to, string $body): Message
{
    $message = Message::create([
        'sender_id' => $from->id,
        'receiver_id' => $to->id,
        'body' => $body,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return $message;
}
}
