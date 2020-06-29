<?php

namespace App\Http\Livewire;

use App\Report;
use App\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $lava;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.dashboard', [
            'reports' => Report::query()
                ->latest()
                ->get(),
            'users' => User::query()
                ->latest()
                ->get(),
        ]);
    }
}
