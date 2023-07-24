<x-modal-confirm
    :listenEvent="'ideaWasMarkedAsNotSpam'"
    :customEventListener="'custom-show-mark-as-not-spam-idea-modal'"
    :title="'Mark Idea as Not Spam'"
    :description="'Are you sure you want to mark this idea as not spam? This action cannot be undone.'"
    :confirmEventName="'markAsNotSpam'"
    :confirmButtonName="'Not Spam'"/>
