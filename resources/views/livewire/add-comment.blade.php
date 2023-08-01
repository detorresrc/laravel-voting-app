<div
    x-init="
    Livewire.on('ideaCommentWasAdded', (params) => {
        isOpen = false
    })
    Livewire.hook('message.processed', (message, component) => {
        if(
            ['statusWasUpdated', 'ideaCommentWasAdded'].includes(message.updateQueue[0].payload.event)
            &&
            message.component.fingerprint.name=='idea-comments'
        ){
            const lastComment = document.querySelector('.comment-container:last-child')
            lastComment.scrollIntoView({ behavior: 'smooth' })

            lastComment.classList.add('bg-green-50')
            setTimeout(() => {
                lastComment.classList.remove('bg-green-50')
            }, 5000)
        }
    })
    "
    class="relative">
    <button
        @click="
            isOpen = !isOpen
            if(isOpen){
                $nextTick(() => $refs.refComment.focus())
            }
        "
        type="button"
        class="flex items-center justify-center h-11 w-36 bg-blue text-white text-sm font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
        Reply
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
        class="absolute z-10 w-64 md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">

        @auth
            <form wire:submit.prevent="addComment" action="#" class="space-y-4 px-4 py-6">
                <div>
                    <textarea x-ref="refComment" wire:model="comment" name="post_comment" id="post_comment" cols="30" rows="4"
                              class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                              placeholder="Go ahead, don't be shy. Share your thoughts..."></textarea>

                    @error('comment')
                        <p class="text-red text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col md:flex-row items-center md:space-x-3">
                    <button type="submit"
                            class="flex items-center justify-center h-11 w-full md:w-1/2 bg-blue text-white text-sm font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                        Post Comment
                    </button>

                    <button type="submit"
                            class="flex items-center justify-center w-full md:w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in mt-2 md:mt-0">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>

                        <span class="ml-1">Attach</span>
                    </button>
                </div>
            </form>
        @else
            <div class="px-4 py-6">
                <p class="font-normal">Please login or crete an account to post a comment.</p>
                <div class="flex items-center space-x-3 mt-8">
                    <a
                        wire:click.prevent="redirectToLoginPage"
                        href="#"
                        class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                        >Login</a>
                    <a href="{{ route('register') }}"
                       class="w-1/2 h-11 text-sm text-center bg-gray-200 text-black-50 font-semibold rounded-xl hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                        >Sign Up</a>
                </div>
            </div>
        @endauth
    </div>
</div>
