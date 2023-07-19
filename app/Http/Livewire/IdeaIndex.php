<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

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
            $this->hasVoted = (boolean)$this->idea->voted_by_user;
        }
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}
