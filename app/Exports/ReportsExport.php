<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportsExport implements FromView
{
    public function view(): View
    {
        return view('export', [
            'users' => User::query()
                ->latest()
                ->get()
        ]);
    }
}
