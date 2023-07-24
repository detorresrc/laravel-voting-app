<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class MarkIdeaAsNotSpam extends Component
{
    public Idea $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markAsNotSpam()
    {
        if(!auth()->check()) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);
        if(auth()->user()->cannot('markAsNotSpam', $this->idea)) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        $this->idea->spam_reports = 0;
        $this->idea->save();

        $this->emit('ideaWasMarkedAsNotSpam', [
            'message' => 'Idea was reset successfully!',
            'idea' => $this->idea->refresh()
        ]);
    }

    public function render()
    {
        return view('livewire.mark-idea-as-not-spam');
    }
}
