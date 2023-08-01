<x-modal-confirm
    :listenEvent="'ideaCommentWasMarkAsSpam'"
    :customEventListener="'custom-show-mark-as-spam-comment-modal'"
    :title="'Mark Comment as Spam'"
    :description="'Are you sure you want to mark this comment as spam? This action cannot be undone.'"
    :confirmEventName="'markAsSpam'"
    :confirmButtonName="'Mark as Spam'"/>
