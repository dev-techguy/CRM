<div class="container">
    <div class="row" wire:poll>
        <div class="col-md-12">
            <hr>
            <h2 class="text-muted text-center">{{ config('app.name') }} CRM Reports</h2>
            <hr>
            <p>{{ \Illuminate\Foundation\Inspiring::quote() }}</p>
            <br>
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <th>Customer Phone Number</th>
                    @php($count = 1)
                    @foreach(\App\Script::query()->get() as $script)
                        <th>Q{{ $count++ }}</th>
                    @endforeach
                    <th>Completed</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->phone_number }}</td>
                        @foreach(\App\Http\Controllers\SystemController::fetchUserReports($user->client) as $report)
                            <td>
                                @if(isset($report->answer))
                                    {{ $report->answer }}
                                @elseif(isset($report->disposition))
                                    {{ $report->disposition }}
                                @else
                                    <span class="badge-danger badge"><span class="fa fa-close"></span></span>
                                @endif
                            </td>
                        @endforeach
                        <td>{{ \App\Http\Controllers\SystemController::elapsedTime($user->created_at) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button wire:target="export" wire:loading.attr="disabled" wire:click="export"
                    class="btn btn-outline-success float-right">
                <div wire:loading>
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                EXPORT <span class="fa fa-file-excel-o"></span>
            </button>
            {{--        <a href="{{ route('export') }}" class="btn btn-outline-success float-right">Export <span--}}
            {{--                class="fa fa-file-excel-o"></span></a>--}}
        </div>
    </div>
</div>
