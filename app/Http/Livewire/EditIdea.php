<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use Livewire\Component;

class EditIdea extends Component
{
    public Idea $idea;
    public $title = null;
    public $category = null;
    public $description = null;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;

        $this->title = $this->idea->title;
        $this->category = $this->idea->category->id;
        $this->description = $this->idea->description;
    }

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:4'
    ];

    public function updateIdea()
    {
        if(!auth()->check()) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);
        if(auth()->user()->cannot('update', $this->idea)) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);

        $this->validate();

        $this->idea->title = $this->title;
        $this->idea->category_id = $this->category;
        $this->idea->description = $this->description;

        $this->idea->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'description' => $this->description
        ]);

        $this->emit('ideaWasUpdated');
    }

    public function render()
    {
        return view('livewire.edit-idea', [
            'categories' => Category::all()
        ]);
    }
}
