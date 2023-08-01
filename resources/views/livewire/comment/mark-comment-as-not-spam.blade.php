<x-modal-confirm
    :listenEvent="'ideaCommentWasMarkAsNotSpam'"
    :customEventListener="'custom-show-mark-as-not-spam-comment-modal'"
    :title="'Mark Comment as Not Spam'"
    :description="'Are you sure you want to mark this comment as not spam?'"
    :confirmEventName="'markAsNotSpam'"
    :confirmButtonName="'Not Spam'"/>
