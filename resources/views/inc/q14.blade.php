<div class="col-md-6">
    <form role="form" wire:submit.prevent="questionFourteen" method="post">
        <span class="contact1-form-title">
					 {{ $script->question }}
				</span>

        <div class="form-check">
            <p>Well {{ $title }} {{ $name }}, thank you for your time, it's been a pleasure talking to you.
                If you have any further clarifications , feel free to contact our website <a href="{{ url('/') }}">www.abc.co</a> or phone number 020
                – 5230028.</p>
        </div>
        <hr>
        @include('inc.alert')

        <hr>
        <div class="form-group">
            <button wire:target="previousQuestion" wire:click="previousQuestion" wire:loading.attr="disabled" class="btn btn-outline-danger pull-left"
                    type="button">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                Previous
            </button>

            <button wire:target="questionFourteen" wire:loading.attr="disabled" class="btn btn-outline-primary pull-right" type="submit">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                End Call
            </button>
        </div>
    </form>
</div>
