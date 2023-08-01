<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;

    public Idea $idea;

    protected $listeners = [
        'ideaCommentWasAdded',
        'ideaCommentWasDeleted',
        'statusWasUpdated'
    ];

    public function mount(Idea $idea) : void
    {
        $this->idea = $idea;
    }

    public function ideaCommentWasAdded() : void
    {
        $this->idea->refresh();
        $this->gotoPage($this->idea->comments()->paginate()->lastPage());
    }

    public function ideaCommentWasDeleted() : void
    {
        $this->gotoPage($this->page);
    }

    public function statusWasUpdated() : void
    {
        $this->ideaCommentWasAdded();
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            'comments' => $this->idea->comments()->with(['user', 'status'])->paginate()->withQueryString()
        ]);
    }
}
