<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Comment;
use App\Models\Idea;
use App\Notifications\CommentAdded;
use Illuminate\Http\Response;
use Livewire\Component;

class AddComment extends Component
{
    use WithAuthRedirects;

    public Idea $idea;

    public $comment;

    protected $rules = [
        'comment' => 'required|min:4'
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function addComment()
    {
        if(auth()->guest()) abort(Response::HTTP_FORBIDDEN);

        $this->validate();

        $comment = new Comment();
        $comment->body = $this->comment;
        $comment->user_id = auth()->user()->id;
        $comment->status_id = 1;

        $this->idea->comments()->save($comment);

        $this->reset('comment');

        $this->idea->user->notify(new CommentAdded($comment));

        $this->emit('ideaCommentWasAdded', [
            'message' => 'Idea comment successfully added!'
        ]);
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
