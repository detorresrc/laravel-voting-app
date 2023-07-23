<x-modal-confirm
    :listenEvent="'ideaWasMarkedAsSpam'"
    :customEventListener="'custom-show-mark-as-spam-idea-modal'"
    :title="'Mark Idea as Spam'"
    :description="'Are you sure you want to mark this idea as spam? This action cannot be undone.'"
    :confirmEventName="'markAsSpam'"
    :confirmButtonName="'Mark as Spam'"/>
