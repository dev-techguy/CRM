<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionFive" method="post">
        <div class="form-check">
            <hr>
            <strong>Q{{ $script->id }}.</strong> {{ $script->question }}
        </div>

        @foreach($script->answers as $scriptAnswer)
        <div class="form-group">
            <input class="form-check-input @error('answer') is-invalid @enderror" type="radio" wire:model.lazy="answer"
                   id="{{ $scriptAnswer }}" value="{{ \Illuminate\Support\Str::lower($scriptAnswer) }}">
            <label class="form-check-label" for="yes"><strong>{{ $scriptAnswer }}</strong></label>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        @endforeach

        @if(($this->answer === 'bad') || ($this->answer === 'poor'))
            <hr>
            <h6>Shall we Continue?</h6>
            <br>
            <div class="form-group">
                <input class="form-check-input  @error('disposition') is-invalid @enderror" type="radio" wire:model.lazy="disposition"
                       id="1" value="1">
                <label class="form-check-label" for="no">{{ $script->dispositions['1'] }}</label>
                @error('disposition')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-check-input  @error('disposition') is-invalid @enderror" type="radio" wire:model.lazy="disposition"
                       id="2" value="2">
                <label class="form-check-label" for="no">{{ $script->dispositions['2'] }}</label>
                @error('disposition')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        @endif


        <hr>
        <div class="form-group">
            <button wire:target="questionFive" wire:loading.attr="disabled" class="btn btn-outline-primary pull-right" type="submit">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Next
            </button>
        </div>
    </form>
    <button wire:target="previousQuestion" wire:click="previousQuestion" wire:loading.attr="disabled" class="btn btn-outline-danger pull-left"
            type="button">
        <div wire:loading>
            <i class="fa fa-spinner fa-spin"></i>
        </div>
        Previous
    </button>
</div>
