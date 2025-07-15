<x-app-layout>
    <head>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <div class="max-w-2xl mx-auto mt-8 space-y-4">
        <h2 class="text-2xl font-bold">Чат с {{ $user->name }}</h2>

        <div class="bg-white rounded-lg shadow p-4 h-96 overflow-y-auto">
            @foreach($messages as $message)
                <div class="mb-2">
                    <strong>{{ $message->sender->id === auth()->id() ? 'Вы' : $message->sender->name }}:</strong>
                    {{ $message->body }}
                    <div class="text-sm text-gray-500">{{ $message->created_at->format('H:i d.m') }}</div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('chat', $user->id) }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="body" placeholder="Сообщение..." class="w-full border rounded p-2" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Отправить</button>
        </form>
    </div>

    <script>
        Echo.private('chat.{{ auth()->id() }}')
            .listen('MessageSent', (e) => {
                const container = document.querySelector('.overflow-y-auto');
    
                const msg = document.createElement('div');
                msg.innerHTML = `
                    <strong>${e.sender_id === {{ auth()->id() }} ? 'Вы' : e.sender_name}:</strong> 
                    ${e.body}
                    <div class="text-sm text-gray-500">${e.created_at}</div>
                `;
    
                container.appendChild(msg);
                container.scrollTop = container.scrollHeight;
            });
    </script>
    
</x-app-layout>
