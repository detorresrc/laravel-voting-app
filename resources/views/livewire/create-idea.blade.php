@auth
<form wire:submit.prevent="createIdea" action="#" method="POST" class="space-y-4 px-4 py-6">
    <div>
        <input wire:model.defer="title" type="text" class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2 text-sm" placeholder="Your Idea">
        @error('title')
            <p class="text-red text-xs mt-1">{{ $message  }}</p>
        @enderror
    </div>
    <div>
        <select wire:model.defer="category" name="category" id="category" class="w-full rounded-xl px-4 py-2 border-none bg-gray-100 text-sm">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="text-red text-xs mt-1">{{ $message  }}</p>
        @enderror
    </div>
    <div>
        <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4" class="w-full bg-gray-100 text-sm rounded-xl border-none placeholder-gray-900" placeholder="Describe your Idea"></textarea>
        @error('description')
            <p class="text-red text-xs mt-1">{{ $message  }}</p>
        @enderror
    </div>
    <div class="flex items-center justify-between space-x-3">
        <button type="button"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in ">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>

            <span class="ml-1">Attach</span>
        </button>
        <button type="submit"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in  px-6 py-3">
            <span>Submit</span>
        </button>
    </div>
</form>
@else
<div class="my-6 space-y-3 text-center">
    <a
        wire:click.prevent="redirectToLoginPage"
        href="#"
        class="inline-block justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
        Login
    </a>
    <a
        href="{{ route('register') }}"
        class="inline-block justify-center w-1/2 h-11 text-xs bg-gray-200 text-black-50 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
        Sign Up
    </a>
</div>
@endauth
