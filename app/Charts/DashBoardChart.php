<?php

declare(strict_types=1);

namespace App\Charts;

use App\Report;
use App\Script;
use App\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class DashBoardChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['Users','Pending Reports', 'Complete Reports', 'Question Scripts'])
            ->dataset('Sample', [count(User::query()->whereNotNull('phone_number')->get()), count(User::query()->get()),count(Report::query()->get()),count(Script::query()->get())]);
    }
}
