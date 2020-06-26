<?php

namespace App\Http\Livewire;

use App\Script;
use Livewire\Component;

class Crm extends Component
{
    public $getStarted = false;
    public $questionCount = 0;

    public function startSession()
    {
        $this->getStarted = true;
        $this->questionCount++;
    }

    public function render()
    {
        return view('livewire.crm', [
            'script' => $this->getStarted
                ? Script::query()->findOrFail($this->questionCount)
                : (object)[]
        ]);
    }
}
