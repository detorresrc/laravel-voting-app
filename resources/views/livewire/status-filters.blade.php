<nav class="hidden md:flex item-center justify-between text-xs text-gray-400">
    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
        <li><a wire:click.prevent="setStatus('All')" href="" class="border-b-4 pb-3 @if(strcasecmp($status,'all')===0) border-blue text-gray-900 @endif">All Ideas (87)</a></li>
        <li><a wire:click.prevent="setStatus('Considering')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'Considering')===0) border-blue text-gray-900 @endif">Considering (6)</a></li>
        <li><a wire:click.prevent="setStatus('In Progress')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'In Progress')===0) border-blue text-gray-900 @endif">In Progress (6)</a></li>
    </ul>
    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
        <li><a wire:click.prevent="setStatus('Implemented')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'Implemented')===0) border-blue text-gray-900 @endif">Implemented (10)</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'Closed')===0) border-blue text-gray-900 @endif">Closed (6)</a></li>
    </ul>
</nav>
