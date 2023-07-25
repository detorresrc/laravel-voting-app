<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = [
        'statusWasUpdated',
        'ideaWasUpdated',
        'ideaWasMarkedAsSpam',
        'ideaWasMarkedAsNotSpam',
        'ideaCommentWasAdded'
    ];

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function render()
    {
        return view('livewire.idea-show');
    }

    public function statusWasUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaWasUpdated()
    {
        $this->statusWasUpdated();
    }

    public function ideaWasMarkedAsSpam()
    {
        $this->statusWasUpdated();
    }

    public function ideaWasMarkedAsNotSpam()
    {
        $this->statusWasUpdated();
    }

    public function ideaCommentWasAdded()
    {
        $this->statusWasUpdated();
    }

    public function vote()
    {
        if(!auth()->check()) $this->redirect(route('login'));
        else{
            if($this->hasVoted){
                try{
                    $this->idea->unvote(auth()->user());
                }catch(VoteNotFoundException $e){
                    //Do nothing
                }
            }else{
                try{
                    $this->idea->vote(auth()->user());
                }catch(DuplicateVoteException $e){}
            }
            $this->idea = Idea::addSelect(['voted_by_user' =>
                Vote::select('id')
                    ->where('user_id', auth()->id())
                    ->whereColumn('idea_id', 'ideas.id')
                ])
                ->withCount('votes')
                ->where('id', $this->idea->id)->first();
            $this->votesCount = $this->idea->votes_count;
            $this->hasVoted = (boolean)$this->idea->voted_by_user;
        }
    }
}
