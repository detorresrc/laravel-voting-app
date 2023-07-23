<x-modal-confirm
    :listenEvent="'ideaWasDeleted'"
    :customEventListener="'custom-show-delete-idea-modal'"
    :title="'Delete Idea'"
    :description="'Are you sure you want to delete this idea? This action cannot be undone.'"
    :confirmEventName="'deleteIdea'"
    :confirmButtonName="'Delete'"/>
