<div class="contact1">
    <div class="container-contact1">
        <div class="contact1-pic js-tilt" data-tilt>
            @if($getStarted)
                <img src="{{ asset('images/server.gif') }}" alt="IMG">
            @else
                <img src="{{ asset('images/crm.gif') }}" alt="IMG">
            @endif

            <center>
                <div wire:poll>
                    <h5>{{ date('F d, Y H:i:s a', strtotime(now())) }}</h5>
                </div>
            </center>
        </div>

        @if($getStarted)
            @if($questionCount == 1)
                @include('inc.q1')
            @elseif($questionCount == 2)
                @include('inc.q2')
            @elseif($questionCount == 3)
                @include('inc.q3')
            @elseif($questionCount == 4)
                @include('inc.q4')
            @elseif($questionCount == 5)
                @include('inc.q5')
            @elseif($questionCount == 6)
                @include('inc.q6')
            @elseif($questionCount == 7)
                @include('inc.q7')
            @elseif($questionCount == 8)
                @include('inc.q8')
            @elseif($questionCount == 9)
                @include('inc.q9')
            @elseif($questionCount == 10)
                @include('inc.q10')
            @elseif($questionCount == 11)
                @include('inc.q11')
            @elseif($questionCount == 12)
                @include('inc.q12')
            @elseif($questionCount == 13)
                @include('inc.q13')
            @elseif($questionCount == 14)
                @include('inc.q14')
            @endif
        @else
            <div class="col-md-6 border-left-0 text-primary">
                @include('inc.alert')
                <h3 class="text-center">Welcome to <strong>ABC</strong></h3>
                <p class="text-center">CRM - <b><i>Customer Relationship Management</i></b></p>
                <br>
                <hr>
                <center>
                    <button wire:target="startSession" wire:loading.attr="disabled" wire:click="startSession"
                            class="btn btn-outline-success">
                        <div wire:loading>
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        START CONVERSATION
                    </button>
                </center>
                <hr>
            </div>
        @endif
    </div>
</div>
