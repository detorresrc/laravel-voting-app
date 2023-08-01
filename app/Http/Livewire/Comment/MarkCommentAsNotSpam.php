<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Services\DecodeModelKey;
use Illuminate\Http\Response;
use Livewire\Component;

class MarkCommentAsNotSpam extends Component
{
    public $commendId;

    protected $listeners = [
        'setMarkAsNotSpamComment'
    ];

    public function setMarkAsNotSpamComment($commentId)
    {
        $this->commendId = $commentId;

        $this->emit('setMarkAsNotSpamCommentCompleted');
    }

    public function markAsNotSpam()
    {
        if(auth()->guest()) abort(Response::HTTP_FORBIDDEN);

        $comment = Comment::findOrFail(DecodeModelKey::decode($this->commendId));

        if(auth()->user()->cannot('markAsNotSpam', $comment)) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        $comment->spam_reports = 0;
        $comment->save();

        $this->emit('ideaCommentWasMarkAsNotSpam', [
            'message' => 'Comment was reset successfully!'
        ]);
    }

    public function render()
    {
        return view('livewire.comment.mark-comment-as-not-spam');
    }
}
