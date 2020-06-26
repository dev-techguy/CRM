<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionThree" method="post">
        <div class="form-check">
            <hr>
            <strong>Q{{ $script->id }}.</strong> Thank you  {{ $name }} {{ $script->question }}
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

        <div class="form-group">
            <p>ABC is a backup service provider that offers you affordable & secure backup solutions. It also offers
                leased server services so customers don’t have to invest in physical servers in their offices which are
                managed by ABC, 24/ 7</p>
        </div>

        <hr>
        <div class="form-group">
            <button wire:target="questionFour" wire:loading.attr="disabled" class="btn btn-outline-primary pull-right"
                    type="submit">
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
