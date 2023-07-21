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
    public $filter;
    public $search;

    protected $queryString = [
        'status' => ['except' => ''],
        'category' => ['except' => ''],
        'filter' => ['except' => ''],
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'queryStringUpdatedStatus'
    ];

    public function mount()
    {
        $this->status = request()->status ?? '';
        $this->category = request()->category ?? '';
        $this->filter = request()->filter ?? '';
        $this->search = request()->search ?? '';
    }

    public function queryStringUpdatedStatus($newStatus) : void
    {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter(): void
    {
        if(strcasecmp($this->filter, 'My Ideas')===0 && !auth()->check()) {
            $this->redirect(route('login'));
        }else
            $this->emit('queryStringUpdatedFilter', $this->filter);
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
                    ->when(strcasecmp($this->filter,'Top Voted')===0, function($query){
                        return $query->orderByDesc('votes_count');
                    })
                    ->when(strcasecmp($this->filter,'My Ideas')===0, function($query){
                        return $query->where('user_id', auth()->id());
                    })
                    ->when(strlen($this->search)>=3, function($query){
                        return $query->where('title', 'like', '%'.trim($this->search).'%');
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
