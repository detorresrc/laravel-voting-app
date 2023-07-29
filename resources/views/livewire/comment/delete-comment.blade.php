<x-modal-confirm
    :listenEvent="'ideaCommentWasDeleted'"
    :customEventListener="'custom-show-delete-idea-comment-modal'"
    :title="'Delete Comment'"
    :description="'Are you sure you want to delete this comment? This action cannot be undone.'"
    :confirmEventName="'deleteIdeaComment'"
    :confirmButtonName="'Delete'"/>
