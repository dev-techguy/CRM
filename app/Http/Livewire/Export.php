<?php

namespace App\Http\Livewire;

use App\Exports\ReportsExport;
use App\User;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public function export()
    {
        Excel::download(new ReportsExport(), 'report.xlsx');
    }

    public function render()
    {
        return view('livewire.export', [
            'users' => User::query()
                ->latest()
                ->get()
        ]);
    }
}
