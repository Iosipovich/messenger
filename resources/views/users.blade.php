<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Пользователи</h2>
        <ul class="space-y-2">
            @foreach($users as $user)
                <li>
                    <a href="{{ route('chat', $user->id) }}" class="text-blue-600 hover:underline">
                        {{ $user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
