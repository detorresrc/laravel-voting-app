<div class="comment-container @if($comment->user->isAdmin()) is-admin @endif bg-white rounded-xl flex cursor-pointer mt-4 relative">
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#" target="_blank">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if($comment->user->isAdmin())
            <div class="font-bold mt-1 text-xs text-left md:text-center text-blue uppercase">ADMIN</div>
            @endif
        </div>
        <div class="w-full md:mx-4 justify-between">
            <div class="text-gray-600 line-clamp-3">{{ $comment->body }}</div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold text-gray-900">{{ $comment->user->name }}</div>
                    <div>{{  $comment->created_at->diffForHumans() }}</div>
                </div>
                <div
                    x-data="{ isOpen: false }"
                    class="flex items-center space-x-2">
                    <button
                        @click="isOpen = !isOpen"
                        class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                        <ul
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
                            class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10">
                            <li>
                                <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Edit Idea</a>
                                <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Mark as Span</a>
                                <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Delete Post</a>
                            </li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
