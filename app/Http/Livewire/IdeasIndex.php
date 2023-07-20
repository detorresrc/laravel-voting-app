<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.ideas-index', [
            'ideas' => Idea::with('category', 'user', 'status')
                ->addSelect(['voted_by_user' =>
                    Vote::select('id')
                        ->where('user_id', auth()->id())
                        ->whereColumn('idea_id', 'ideas.id')
                ])
                ->withCount('votes')
                ->orderBy('id', 'desc')
                ->simplePaginate(10)
        ]);
    }
}
