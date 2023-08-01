<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Services\DecodeModelKey;
use Illuminate\Http\Response;
use Livewire\Component;

class DeleteComment extends Component
{

    public $commendId;

    protected $listeners = [
        'deleteIdeaComment',
        'setDeleteComment'
    ];

    public function setDeleteComment($commentId)
    {
        $this->commendId = $commentId;

        $this->emit('setEditCommentCompleted');
    }

    public function deleteIdeaComment()
    {
        if(auth()->guest()) abort(Response::HTTP_FORBIDDEN);

        $comment = Comment::findOrFail(DecodeModelKey::decode($this->commendId));

        if(auth()->user()->cannot('delete', $comment)) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        $comment->delete();

        $this->emit('ideaCommentWasDeleted', [
            'message' => 'Comment was deleted successfully!'
        ]);
    }

    public function render()
    {
        return view('livewire.comment.delete-comment');
    }
}
