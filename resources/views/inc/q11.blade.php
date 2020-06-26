<div class="col-md-6">
    @include('inc.alert')
    <form role="form" wire:submit.prevent="questionEleven" method="post">
        <div class="form-check">
            <hr>
            <strong>Q{{ $script->id }}.</strong> {{ $script->question }}
        </div>

        <div class="form-group">
            <label class="form-check-label" for="email"><strong>Enter Your E-mail Address</strong></label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" wire:model.lazy="email"
                   id="email" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <hr>
        <div class="form-group">
            <button wire:target="questionEleven" wire:loading.attr="disabled" class="btn btn-outline-primary pull-right"
                    type="submit">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Next
            </button>
        </div>
    </form>
    <button wire:target="previousQuestion" wire:click="previousQuestion" wire:loading.attr="disabled"
            class="btn btn-outline-danger pull-left"
            type="button">
        <div wire:loading>
            <i class="fa fa-spinner fa-spin"></i>
        </div>
        Previous
    </button>
</div>
