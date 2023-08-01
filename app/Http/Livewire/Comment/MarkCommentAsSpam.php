<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Services\DecodeModelKey;
use Illuminate\Http\Response;
use Livewire\Component;

class MarkCommentAsSpam extends Component
{
    public $commendId;

    protected $listeners = [
        'setMarkAsSpamComment'
    ];

    public function setMarkAsSpamComment($commentId)
    {
        $this->commendId = $commentId;

        $this->emit('setMarkAsSpamCommentCompleted');
    }

    public function markAsSpam()
    {
        if(auth()->guest()) abort(Response::HTTP_FORBIDDEN);

        $comment = Comment::findOrFail(DecodeModelKey::decode($this->commendId));

        $comment->spam_reports++;
        $comment->save();

        $this->emit('ideaCommentWasMarkAsSpam', [
            'message' => 'Comment was marked as spam!'
        ]);
    }

    public function render()
    {
        return view('livewire.comment.mark-comment-as-spam');
    }
}
