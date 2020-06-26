<div class="contact1">
    <div class="container-contact1">
        <div class="contact1-pic js-tilt" data-tilt>
            @if($getStarted)
                <img src="{{ asset('images/server.gif') }}" alt="IMG">
            @else
                <img src="{{ asset('images/crm.gif') }}" alt="IMG">
            @endif
        </div>

        @if($getStarted)
            @if($questionCount == 1)
                @include('inc.q1')
            @endif
        @else
            <div class="col-md-6 border-left-0 text-primary">
                <h3 class="text-center">Welcome to <strong>ABC</strong></h3>
                <p class="text-center">CRM - <b><i>Customer Relationship Management</i></b></p>
                <br>
                <center>
                    <button wire:loading.attr="disabled" wire:click="startSession"
                            class="btn btn-outline-success btn-lg">
                        <div wire:loading>
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        START CONVERSATION
                    </button>
                </center>
            </div>
        @endif
    </div>
</div>
