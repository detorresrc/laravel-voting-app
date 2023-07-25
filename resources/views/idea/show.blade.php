<x-app-layout>
    <a href="{{ $backurl }}" class="flex items-center font-semibold hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="ml-2">All ideas (or back or chosen category with filters)</span>
    </a>

    @livewire('idea-show', ['idea' => $idea, 'votesCount' => $votesCount])

    <x-modals-container :idea="$idea"/>

    <x-success-notification/>

    @livewire('idea-comments', ['idea' => $idea])

</x-app-layout>
