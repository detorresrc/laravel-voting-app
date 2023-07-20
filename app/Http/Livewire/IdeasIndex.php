<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public $status;
    public $category;

    protected $queryString = [
        'status',
        'category'
    ];

    protected $listeners = [
        'queryStringUpdatedStatus'
    ];

    public function mount()
    {
        $this->status = request()->status ?? 'All';
        $this->category = request()->category ?? 'All Categories';
    }

    public function queryStringUpdatedStatus($newStatus) : void
    {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function updatingCategory($val)
    {
        $this->resetPage();

        $this->category = $val;
    }

    public function render()
    {
        $statuses = Status::all()->pluck('id','name');
        $categories = Category::all();

        return view('livewire.ideas-index', [
            'ideas' =>
                Idea::with('category', 'user', 'status')
                    ->when($this->status!='All', function($query) use ($statuses){
                        if(isset($statuses[$this->status]))
                            return $query->where('status_id', $statuses[$this->status]);

                        return $query;
                    })
                    ->when($this->category!='All Categories', function($query) use ($categories){
                        $categories = $categories->pluck('id', 'name');
                        
                        if(isset($categories[$this->category]))
                            return $query->where('category_id', $categories[$this->category]);

                        return $query;
                    })
                    ->addSelect(['voted_by_user' =>
                        Vote::select('id')
                            ->where('user_id', auth()->id())
                            ->whereColumn('idea_id', 'ideas.id')
                    ])
                    ->withCount('votes')
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10),
            'categories' => $categories
        ]);
    }
}
