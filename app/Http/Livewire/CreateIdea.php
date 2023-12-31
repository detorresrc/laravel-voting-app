<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use Livewire\Component;

class CreateIdea extends Component
{
    use WithAuthRedirects;

    public $title = null;
    public $category = null;
    public $description = null;

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer',
        'description' => 'required|min:4'
    ];

    public function render()
    {
        return view('livewire.create-idea',[
            'categories' => Category::all()
        ]);
    }

    public function createIdea()
    {
        if(!auth()->check()) abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);
        $this->validate();

        Idea::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->reset();
        session()->flash('success_message', 'Idea was added successfully!');

        return redirect()->route('idea.index');
    }
}
