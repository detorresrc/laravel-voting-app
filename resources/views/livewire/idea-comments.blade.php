<div>
    @if($comments->isEmpty())
        <div class="mx-auto w-70 mt-12 mb-8">
            <img src="{{ asset('img/no-ideas.svg') }}" alt="No Comments" class="mx-auto" style="mix-blend-mode: luminosity;">
            <div class="text-gray-400 text-center font-bold mt-6">No comments yet...</div>
        </div>
    @else
        <div class="comments-container space-y-6 md:ml-22 relative pt-4 my-8 mt-1">
            @foreach($comments as $comment)
                <livewire:idea-comment :idea="$idea" :comment="$comment" :key="$comment->id" />
            @endforeach
        </div> <!-- end comments-container -->
    @endif
</div>
