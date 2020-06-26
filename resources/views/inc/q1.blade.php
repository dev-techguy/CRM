<form role="form" wire:submit.prevent="questionOne" method="post">
				<span class="contact1-form-title">
					Hello , {{ \App\Http\Controllers\SystemController::pass_greetings_to_user() }}
				</span>
    <div class="form-check">
        <hr>
        {{ $script->question }} {{ $title }} {{ $name }}
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" wire:model.lazy="answer" id="yes" value="yes">
        <label class="form-check-label" for="yes">
            {{ $script->answers['yes'] }}
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" wire:model.lazy="answer" id="no" value="no">
        <label class="form-check-label" for="no">
            {{ $script->answers['no'] }}
        </label>
    </div>

    <hr>
    <div class="form-check">
        <button wire:loading.attr="disabled" class="btn btn-outline-primary pull-right" type="submit">
            <div wire:loading>
                <i class="fa fa-spinner fa-spin"></i>
            </div>
            Next
        </button>
    </div>
</form>
