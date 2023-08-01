@props([
    'redirect' => false,
    'messageToDisplay' => ''
])

@push('modals')
<div
    x-cloak
    x-init="
        @if($redirect)
            $nextTick(()=>showNotification('{{ $messageToDisplay }}'))
        @else
            listeners = [
                'ideaWasUpdated',
                'ideaWasMarkedAsSpam',
                'ideaWasMarkedAsNotSpam',
                'ideaCommentWasAdded',
                'ideaCommentWasUpdated',
                'ideaCommentWasDeleted',
                'ideaCommentWasMarkAsSpam',
                'ideaCommentWasMarkAsNotSpam'
            ]
            listeners.forEach((listener) => {
                Livewire.on(listener, (params) => {
                    showNotification(params.message)
                })
            })
        @endif
        "
    x-data="{
        isOpen: false,
        messageToDisplay: '',
        showNotification(message) {
            this.messageToDisplay = message
            this.isOpen=true
            setTimeout(()=>{
                this.isOpen=false
            }, 5000)
        }
    }
    "
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-8"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-8"
    @keydown.escape.window="isOpen = false"
    class="flex justify-between max-w-xs sm:max-w-sm w-full fixed bottom-0 right-0 bg-white rounded-xl shadow-lg border px-4 py-5 mx-2 sm:mx-6 my-8">
    <div class="flex items-center ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="ml-2 font-semibold text-gray-500 text-sm sm:text-base" x-text="messageToDisplay"></span>
    </div>
    <div>
        <button @click.prevent="isOpen = false" class="text-gray-400 hover:text-gray-500">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endpush
