<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionSeven" method="post">
        <div class="form-check">
            <hr>
            <strong>Q{{ $script->id }}.</strong> {{ $script->question }}
        </div>

        @foreach($script->answers as $scriptAnswer)
            <div class="form-group">
                <input class="form-check-input @error('answer') is-invalid @enderror" type="radio"
                       wire:model.lazy="answer"
                       id="{{ $scriptAnswer }}" value="{{ \Illuminate\Support\Str::lower($scriptAnswer) }}">
                <label class="form-check-label" for="yes"><strong>{{ $scriptAnswer }}</strong></label>
                @error('answer')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        @endforeach

        <hr>
        <div class="form-group">
            <button wire:click="previousQuestion" wire:loading.attr="disabled" class="btn btn-outline-danger pull-left"
                    type="button">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Previous
            </button>

            <button wire:loading.attr="disabled" class="btn btn-outline-primary pull-right" type="submit">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Next
            </button>
        </div>
    </form>
</div>
