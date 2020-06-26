<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionTwelve" method="post">
        <div class="form-check">
            <hr>
            <strong>Q{{ $script->id }}.</strong> {{ $script->question }}
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

        @if($answer === 'yes')
            <div class="form-group">
                <textarea wire:model.lazy="text" id="text" cols="30" rows="10" class="form-control border-dark @error('answer') is-invalid @enderror">{{ old('text') }}</textarea>
                @error('text')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        @endif

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
            <button wire:target="previousQuestion" wire:click="previousQuestion" wire:loading.attr="disabled"
                    class="btn btn-outline-danger pull-left"
                    type="button">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Previous
            </button>

            <button wire:target="questionTwelve" wire:loading.attr="disabled" class="btn btn-outline-primary pull-right"
                    type="submit">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Next
            </button>
        </div>
    </form>
</div>
