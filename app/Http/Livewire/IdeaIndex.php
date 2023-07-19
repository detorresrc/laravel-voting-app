<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Mockery\Exception;

class IdeaIndex extends Component
{
    public $idea;
    public $hasVoted;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->hasVoted = $idea->voted_by_user;
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
            $this->hasVoted = (boolean)$this->idea->voted_by_user;
        }
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}
