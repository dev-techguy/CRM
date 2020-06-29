<table class="table table-responsive">
    <thead>
    <tr>
        <th>Customer Phone Number</th>
        @php($count = 1)
        @foreach(\App\Script::query()->get() as $script)
            <th>{{ $script->question }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->phone_number }}</td>
            @foreach(\App\Http\Controllers\SystemController::fetchUserReports($user->client) as $report)
                @if(isset($report->answer))
                    {{ $report->answer }}
                @elseif(isset($report->disposition))
                    {{ $report->disposition }}
                @else
                    <span class="badge-danger badge"><span class="fa fa-close"></span></span>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
