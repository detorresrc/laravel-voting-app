<div x-data="{ isOpen: false }"
     x-init="
        window.livewire.on('statusWasUpdated', () => {
            isOpen = false;
        });
     "
     class="relative">
    <button
        @click="isOpen = !isOpen"
        type="button"
        class="flex items-center justify-center w-36 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in mt-2 md:mt-0">
        <span>Set Status</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div
        x-cloak
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
        class="absolute z-20 w-64 md:w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
        <form wire:submit.prevent="setStatus" action="#" class="space-y-4 px-4 py-6">
            <div class="space-y-2">
                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" checked class="text-gray-600 bg-gray-300 border-none" name="radio-direct" value="1">
                        <span class="ml-2">Open</span>
                    </label>
                </div>
                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="text-purple bg-gray-300 border-none" name="radio-direct" value="2">
                        <span class="ml-2">Considering</span>
                    </label>
                </div>
                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="text-yellow bg-gray-300 border-none" name="radio-direct" value="3">
                        <span class="ml-2">In-Progress</span>
                    </label>
                </div>
                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="text-green bg-gray-300 border-none" name="radio-direct" value="4">
                        <span class="ml-2">Implemented</span>
                    </label>
                </div>
                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="text-red bg-gray-300 border-none" name="radio-direct" value="5">
                        <span class="ml-2">Closed</span>
                    </label>
                </div>
            </div>
            <div>
                <textarea name="update_comment" id="update_comments" cols="30" rows="3"
                          class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                          placeholder="Add an update comment (optional)"></textarea>
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
                        class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in ">
                    <span>Update</span>
                </button>
            </div>
            <div>
                <label for="" class="inline-flex items-center font-normal">
                    <input type="checkbox" name="notify_voters" checked class="rounded bg-gray-200">
                    <span class="ml-2">Notify all voters</span>
                </label>
            </div>
        </form>
    </div>
</div>

