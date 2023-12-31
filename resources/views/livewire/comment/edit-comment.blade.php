<div
    x-cloak
    x-init="
        Livewire.on('setEditComment', (params) => {
            isOpen = true
            setTimeout(()=>$refs.refBody.focus(), 300)
        })
        Livewire.on('ideaCommentWasUpdated', () => {
            isOpen = false
        })
    "
    x-data="{isOpen: false}"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    class="relative z-10"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                x-show="isOpen"
                x-transition:enter.duration.200ms
                x-transition:leave.duration.200ms
                x-transition.scale.origin.top
                class="modal relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <div class="absolute top-0 right-0 pt-3 pr-3">
                    <button
                        @click="isOpen = false"
                        class="text-gray.400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <h3 class="text-center text-lg font-medium text-gray-900">Edit Comment</h3>
                    <form wire:submit.prevent="updateComment" action="#" method="POST" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea x-ref="refBody" wire:model.defer="body" name="idea" id="idea" cols="30" rows="4" class="w-full bg-gray-100 text-sm rounded-xl border-none placeholder-gray-900" placeholder="Go ahead, don't be shy. Share your thoughts..."></textarea>
                            @error('body')
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
                                <span>Update</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
