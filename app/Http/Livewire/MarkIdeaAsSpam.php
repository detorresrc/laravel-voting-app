<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class MarkIdeaAsSpam extends Component
{
    public Idea $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markAsSpam()
    {
        if(!auth()->check()) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        $this->idea->spam_reports++;
        $this->idea->save();

        $this->emit('ideaWasMarkedAsSpam', [
            'message' => 'Idea was marked as spam!',
            'idea' => $this->idea->refresh()
        ]);
    }

    public function render()
    {
        return view('livewire.mark-idea-as-spam');
    }
}
