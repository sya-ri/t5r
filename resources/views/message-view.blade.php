<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Message') }}
        </h2>
    </x-slot>

    <div class="md:container md:mx-auto shadow-lg py-2">
        <div class="m-2 mb-0">
            <div class="flex justify-between text-lg border-b">
                <p>{{ $message->user->name }}</p>
                <a href="">
                    <p>{{ rand(0, 100) }} 🖤</p>
                </a>
            </div>
            <p class="text-sm">{{ $message->created_at->format('Y/m/d H:i:s') }}</p>
            <p class="text-base">{{ $message->content }}</p>
        </div>
    </div>
</x-app-layout>
