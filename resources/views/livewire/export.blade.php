<div class="container">
    <div class="row" wire:poll>
        <br>
        <br>
        <br>
        <div class="col-md-12">
            <h2>{{ config('app.name') }} CRM Reports</h2>
            <p>{{ \Illuminate\Foundation\Inspiring::quote() }}</p>
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
        </div>
        {{--        <button wire:target="startSession" wire:loading.attr="disabled" wire:click="export"--}}
        {{--                class="btn btn-outline-success float-right">--}}
        {{--            <div wire:loading>--}}
        {{--                <i class="fa fa-spinner fa-spin"></i>--}}
        {{--            </div>--}}
        {{--           EXPORT <span class="fa fa-file-excel-o"></span>--}}
        {{--        </button>--}}
        <a href="{{ route('export') }}" class="btn btn-outline-success float-right">Export <span
                class="fa fa-file-excel-o"></span></a>
    </div>
</div>
