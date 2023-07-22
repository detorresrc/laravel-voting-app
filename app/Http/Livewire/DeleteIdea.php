<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class DeleteIdea extends Component
{
    public Idea $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function deleteIdea()
    {
        if(!auth()->check()) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);
        if(auth()->user()->cannot('delete', $this->idea)) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        Vote::whereIdeaId($this->idea->id)->delete();
        Idea::destroy($this->idea->id);

        return redirect(route('idea.index'));
    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}
