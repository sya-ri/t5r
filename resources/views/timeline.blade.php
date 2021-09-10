<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timeline') }}
        </h2>
    </x-slot>

    @foreach($messages as $message)
        <div class="mb-2">
            <p>{{ $message->created_at }} {{ $message->user->name }} {{ $message->content  }}</p>
        </div>
    @endforeach
</x-app-layout>
