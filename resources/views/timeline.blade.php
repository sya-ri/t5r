<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timeline') }}
        </h2>
    </x-slot>

    <div class="md:container md:mx-auto shadow-lg py-2">
        <div class="m-2">
            <livewire:create-message-form />
        </div>
        @foreach($messages as $message)
            <div class="border-b border-gray-400 m-2">
                <div class="flex justify-between text-lg border-b">
                    <p>{{ $message->user->name }}</p>
                    <livewire:like-button :message="$message" />
                </div>
                <a href="{{ route('message.view', $message->id) }}">
                    <p class="text-sm">{{ $message->created_at->format('Y/m/d H:i:s') }}</p>
                    <p class="text-base break-all">{{ $message->content }}</p>
                </a>
            </div>
        @endforeach
        <p class="text-center ">↓</p>
    </div>
</x-app-layout>
