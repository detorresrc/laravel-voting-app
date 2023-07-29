<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Services\DecodeModelKey;
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
        $comment = Comment::findOrFail(DecodeModelKey::decode($this->commendId));
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
