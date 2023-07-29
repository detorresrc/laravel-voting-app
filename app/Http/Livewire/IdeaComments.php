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
        'ideaCommentWasDeleted'
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function ideaCommentWasAdded()
    {
        $this->idea->refresh();
        $this->gotoPage($this->idea->comments()->paginate()->lastPage());
    }

    public function ideaCommentWasDeleted()
    {
        $this->gotoPage($this->page);
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            'comments' => $this->idea->comments()->with('user')->paginate()->withQueryString()
        ]);
    }
}
