<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionOne" method="post">
				<span class="contact1-form-title">
					Hello , {{ \App\Http\Controllers\SystemController::pass_greetings_to_user() }}
				</span>
        <div class="form-check">
            <hr>
            <strong>Q{{ $script->id }}.</strong> {{ $script->question }} {{ $name }}
        </div>

        <div class="form-group">
            <input class="form-check-input @error('answer') is-invalid @enderror" type="radio" wire:model.lazy="answer"
                   id="yes" value="yes">
            <label class="form-check-label" for="yes"><strong>{{ $script->answers['yes'] }}</strong></label>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="form-group">
            <input class="form-check-input  @error('answer') is-invalid @enderror" type="radio" wire:model.lazy="answer"
                   id="no" value="no">
            <label class="form-check-label" for="no"><strong>{{ $script->answers['no'] }}</strong></label>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <hr>
        <div class="form-group">
            <button wire:target="questionOne" wire:loading.attr="disabled" class="btn btn-outline-primary pull-right" type="submit">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Next
            </button>
        </div>
    </form>
</div>
