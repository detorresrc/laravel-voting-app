<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;

class IdeaComment extends Component
{
    public Comment $comment;
    public Idea $idea;

    protected $listeners = [
        'ideaCommentWasUpdated',
        'ideaCommentWasMarkAsSpam',
        'ideaCommentWasMarkAsNotSpam'
    ];

    public function mount(Comment $comment, Idea $idea)
    {
        $this->comment = $comment;
        $this->idea = $idea;
    }

    public function ideaCommentWasUpdated()
    {
        $this->comment->refresh();
    }

    public function ideaCommentWasMarkAsSpam()
    {
        $this->comment->refresh();
    }

    public function ideaCommentWasMarkAsNotSpam()
    {
        $this->comment->refresh();
    }

    public function render()
    {
        return view('livewire.idea-comment');
    }
}
