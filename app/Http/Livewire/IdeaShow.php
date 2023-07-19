<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

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

    public function vote()
    {
        if(!auth()->check()) $this->redirect(route('login'));
        else{
            if($this->hasVoted){
                $this->idea->unvote(auth()->user());
            }else{
                $this->idea->vote(auth()->user());
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
