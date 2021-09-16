<div>
    @error('content')
        <span class="text-red-600 text-sm error">{{ $message }}</span>
    @enderror
    <div class="border border-gray-800">
        <textarea class="block resize-none border-none w-full p-2" rows="4" maxlength="{{ \App\Http\Livewire\CreateMessageForm::MaxLength }}" wire:model.defer="content" type="text"></textarea>
        <button class="border-t border-gray-800 bg-green-300 w-full" wire:click="onSubmit">
            <p class="text-lg text-center m-1">Submit</p>
        </button>
    </div>
</div>
