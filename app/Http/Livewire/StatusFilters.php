<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status;

    public $filter;

    public $statusCount = [];

    protected $listeners = [
        'queryStringUpdatedFilter'
    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->statusCount = Status::getStatusCount();
        $this->status = request()->status ?? 'All';
        $this->filter = request()->filter ?? '';

        if(Route::currentRouteName() == 'idea.show'){
            $this->status = null;
        }
    }

    /**
     * @param $newVal
     * @return void
     */
    public function queryStringUpdatedFilter($newVal) : void
    {
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->emit('queryStringUpdatedStatus', $status);

        if($this->getPreviousRoute() == 'idea.show') {
            return redirect()->route('idea.index', [
                'status' => $this->status
            ]);
        }
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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
