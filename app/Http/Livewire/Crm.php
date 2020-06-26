<?php

namespace App\Http\Livewire;

use App\CallBack;
use App\Script;
use Exception;
use Faker\Factory;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Psr\SimpleCache\InvalidArgumentException;

class Crm extends Component
{
    // this are used globally for the entire page
    public $answer;
    public $name;
    public $title;
    public $script;
    public $disposition;
    public $dateTime;
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
     * updated function
     * validates in real time
     * @param $field
     * @throws ValidationException
     */
    public function updated($field)
    {
        $this->validateOnly($field, [
            'dateTime' => ['nullable', 'date', 'after_or_equal:now'],
        ]);
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
     * this function make it able
     * for one to get back to the
     * previous quiz
     * @return void
     */
    public function previousQuestion()
    {
        $this->questionCount -= 1;
        $this->script = Script::query()->findOrFail($this->questionCount);
    }

    /**
     * common validation
     */
    public function commonValidation()
    {
        $this->validate([
            'answer' => ['required', 'string']
        ]);

        if (isset($this->answer)) {
            $this->resetErrorBag('answer');
        } else {
            $this->addError('answer', 'Please select an option.');
        }
    }

    /**
     * process q1
     * @return void
     */
    public function questionOne()
    {
        $this->commonValidation();

        if ($this->answer === 'yes') {
            $this->questionCount = $this->script->next_question['yes'];
        } else {
            $this->questionCount = $this->script->next_question['no'];
        }
        $this->script = Script::query()->findOrFail($this->questionCount);
        $this->answer = null;
    }

    /**
     * process q2
     * @return void
     * @throws Exception
     */
    public function questionTwo()
    {
        $this->commonValidation();
        $this->validate([
            'dateTime' => ['nullable', 'date', 'after_or_equal:now'],
        ]);

        if ($this->answer === 'yes') {
            // store Call back date
            $callBack = CallBack::query()->create([
                'next_call_date' => $this->dateTime
            ]);

            $this->questionCount = 0;
            $this->getStarted = false;
            cache()->forget('name_and_title' . request()->getClientIp());
            session()->flash('success', 'We have set you a call back date. Which is on ' . date('F d, Y H:i a', strtotime($callBack->next_call_date)));
        } elseif ($this->answer === 'no') {
            $this->questionCount = 0;
            $this->getStarted = false;
            cache()->forget('name_and_title' . request()->getClientIp());
            session()->flash('success', 'Thank you for contacting us.');
        }

    }

    /**
     * process q3
     * @return void
     * @throws Exception
     */
    public function questionThree()
    {
        $this->commonValidation();

        if ($this->answer === 'yes') {
            $this->questionCount = $this->script->next_question['yes'];
            $this->script = Script::query()->findOrFail($this->questionCount);
            $this->answer = null;
        } elseif ($this->answer === 'no') {
            $this->questionCount = 0;
            $this->getStarted = false;
            cache()->forget('name_and_title' . request()->getClientIp());
            session()->flash('success', 'Thank you for contacting us.');
        }
    }

    /**
     * process q4
     * @return void
     */
    public function questionFour()
    {
        $this->commonValidation();

        if (($this->answer === 'yes') || ($this->answer === 'no')) {
            $this->questionCount = $this->script->next_question['yes'];
            $this->script = Script::query()->findOrFail($this->questionCount);
            $this->answer = null;
        }
    }

    /**
     * process q5
     * @return void
     * @throws Exception
     */
    public function questionFive()
    {
        $this->commonValidation();

        if (($this->answer === 'good') || ($this->answer === 'excellent')) {
            $this->questionCount = $this->script->next_question['excellent'];
            $this->script = Script::query()->findOrFail($this->questionCount);
            $this->answer = null;
        } elseif (($this->answer === 'bad') || ($this->answer === 'poor')) {

            $this->validate([
                'disposition' => ['required', 'string']
            ]);

            if ($this->disposition === '1') {
                $this->questionCount = $this->script->next_question['excellent'];
                $this->script = Script::query()->findOrFail($this->questionCount);
                $this->answer = null;
            } else {
                $this->questionCount = 0;
                $this->getStarted = false;
                cache()->forget('name_and_title' . request()->getClientIp());
                session()->flash('success', 'Thank you for contacting us.');
            }
        }
    }

    /**
     * process q6
     */
    public function questionSix()
    {

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
