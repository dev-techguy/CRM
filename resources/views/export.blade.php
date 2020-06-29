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
                <td>{{ $report->answer }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
