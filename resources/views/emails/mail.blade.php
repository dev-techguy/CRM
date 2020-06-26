@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.newfeatureStart')

    <h4 class="secondary"><strong>{{ \App\Http\Controllers\SystemController::pass_greetings_to_user() }}
            , {{ $name }}</strong></h4>
    <p>{{ $body }}</p>

    @include('beautymail::templates.widgets.newfeatureEnd')

@stop
