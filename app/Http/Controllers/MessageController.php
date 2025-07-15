<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Services\MessageService;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected MessageService $service;
    
    public function index(User $user)
    {
        $authUser = Auth::user();

        // Получить сообщения между двумя пользователями
        $messages = Message::where(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $authUser->id)
                ->where('receiver_id', $user->id);
        })
            ->orWhere(function ($query) use ($authUser, $user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', $authUser->id);
            })
            ->orderBy('created_at')
            ->get();

        return view('chat', compact('user', 'messages'));
    }

    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    // Отправить сообщение
    public function store(StoreMessageRequest $request, User $user)
    {
        $this->service->sendMessage(auth()->user(), $user, $request->validated()['body']);
        return redirect()->route('chat', $user->id);
    }
}
