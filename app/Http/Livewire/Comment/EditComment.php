<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Services\DecodeModelKey;
use Illuminate\Http\Response;
use Livewire\Component;

class EditComment extends Component
{
    public Comment $comment;
    public $body;

    protected $listeners = [
        'setEditComment'
    ];

    protected $rules = [
        'body' => 'required|min:4'
    ];

    public function setEditComment($commentId)
    {
        $this->comment = Comment::findOrFail( DecodeModelKey::decode($commentId) );
        $this->body = $this->comment->body;
    }

    public function updateComment()
    {
        if(auth()->guest()) abort(Response::HTTP_FORBIDDEN);
        if(auth()->user()->cannot('update', $this->comment)) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        $data = $this->validate();

        $this->comment->update([
            'body' => $data['body']
        ]);

        $this->emit('ideaCommentWasUpdated', [
            'message' => 'Idea comment successfully updated!'
        ]);
    }

    public function render()
    {
        return view('livewire.comment.edit-comment');
    }
}
