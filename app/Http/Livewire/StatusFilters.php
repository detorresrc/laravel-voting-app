<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'All';

    protected $queryString = [
        'status'
    ];

    public function mount(): void
    {
        if(Route::currentRouteName() == 'idea.show'){
            $this->status = null;
            $this->queryString = [];
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;

//        if($this->getPreviousRoute() == 'idea.show') {
            return redirect()->route('idea.index', [
                'status' => $this->status
            ]);
//        }
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.status-filters');
    }

    /**
     * @return string|null
     */
    public function getPreviousRoute(): ?string
    {
        return app('router')->getRoutes()->match(
            app('request')->create(
                url()->previous()
            )
        )->getName();
    }
}
