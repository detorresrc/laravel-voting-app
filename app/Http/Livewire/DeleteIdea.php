<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\Comment;
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

        Idea::destroy($this->idea->id);

        session()->flash('success_message', 'Idea was deleted successfully!');

        return redirect(route('idea.index'));
    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}
