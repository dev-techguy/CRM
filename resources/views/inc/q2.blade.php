<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionTwo" method="post">
        <div class="form-check">
            <hr>
            Can I talk to {{ $title }} {{ $name }} {{ $script->question }}
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
                <label class="form-check-label" for="dateTime">Set Date And Time</label>
                <input class="form-control  @error('dateTime') is-invalid @enderror" type="datetime-local"
                       wire:model.lazy="dateTime" id="dateTime">
                @error('dateTime')
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

        @if($answer === 'no')
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
