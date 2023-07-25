<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;

class IdeaComment extends Component
{
    public Comment $comment;
    public Idea $idea;

    public function mount(Comment $comment, Idea $idea)
    {
        $this->comment = $comment;
        $this->idea = $idea;
    }

    public function render()
    {
        return view('livewire.idea-comment');
    }
}
