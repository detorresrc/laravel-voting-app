<nav class="hidden md:flex item-center justify-between text-xs text-gray-400">
    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
        <li><a wire:click.prevent="setStatus('All')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'all')===0) border-blue text-gray-900 @endif">All Ideas ({{ array_sum($statusCount) ?? 0  }})</a></li>
        <li><a wire:click.prevent="setStatus('Considering')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'Considering')===0) border-blue text-gray-900 @endif">Considering ({{ $statusCount[2] ?? 0  }})</a></li>
        <li><a wire:click.prevent="setStatus('In Progress')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'In Progress')===0) border-blue text-gray-900 @endif">In Progress ({{ $statusCount[3] ?? 0  }})</a></li>
    </ul>
    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
        <li><a wire:click.prevent="setStatus('Implemented')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'Implemented')===0) border-blue text-gray-900 @endif">Implemented ({{ $statusCount[4] ?? 0  }})</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if(strcasecmp($status,'Closed')===0) border-blue text-gray-900 @endif">Closed ({{ $statusCount[5] ?? 0  }})</a></li>
    </ul>
</nav>
