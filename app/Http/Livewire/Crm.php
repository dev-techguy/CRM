<?php

namespace App\Http\Livewire;

use App\Script;
use Exception;
use Faker\Factory;
use Livewire\Component;
use Psr\SimpleCache\InvalidArgumentException;

class Crm extends Component
{
    // this are used globally for the entire page
    public $answer;
    public $name;
    public $title;
    public $script;
    public $getStarted = false;
    public $questionCount = 0;

    /**
     * this function is run when the
     * page first loads
     * @return void
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function mount()
    {
        // flush everything when the page is reloaded
        if (cache()->has('name_and_title' . request()->getClientIp()))
            cache()->forget('name_and_title' . request()->getClientIp());
    }

    /**
     * this function starts the
     * conversation interactions
     * @return void
     * @throws InvalidArgumentException
     */
    public function startSession()
    {
        $this->getStarted = true;
        $this->questionCount++;
        $this->title = $this->cacheNameAndTitle()[0];
        $this->name = $this->cacheNameAndTitle()[1];
        $this->script = Script::query()->findOrFail($this->questionCount);
    }

    /**
     * store name a temporary session
     * @return mixed
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function cacheNameAndTitle()
    {
        if (cache()->has('name_and_title' . request()->getClientIp()))
            return cache()->get('name_and_title' . request()->getClientIp());
        return cache()->remember('name_and_title' . request()->getClientIp(), now()->addHour(), function () {
            $name = Factory::create()->firstName;
            $title = Factory::create()->title;
            return [$title, $name];
        });
    }

    /**
     * process q1
     * @return void
     */
    public function questionOne()
    {
        if ($this->answer === 'yes') {
            $this->questionCount = $this->script->next_question['yes'];
        } else {
            $this->questionCount = $this->script->next_question['no'];
        }
        $this->script = Script::query()->findOrFail($this->questionCount);
    }

    public function render()
    {
        return view('livewire.crm', [
            'script' => $this->getStarted
                ? $this->script
                : (object)[]
        ]);
    }
}
