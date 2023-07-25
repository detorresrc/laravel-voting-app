<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaComments extends Component
{
    public Idea $idea;

    protected $listeners = [
        'ideaCommentWasAdded'
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function ideaCommentWasAdded()
    {
        $this->idea->refresh();
    }

    public function render()
    {
        return view('livewire.idea-comments', [
//            'comments' => $this->idea->comments()->with(['user'])->latest()->get()
            'comments' => $this->idea->comments
        ]);
    }
}
