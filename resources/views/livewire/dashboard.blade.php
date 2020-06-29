<div class="container">
    <div class="row" wire:poll.100000ms>
        <div class="col-md-12">
            <hr>
            <h3 class="text-center text-muted">{{ config('app.name') }} DashBoard</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Customers</h5>
                    <p class="card-text">{{ number_format(count($users)) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Complete Scripts</h5>
                    <p class="card-text">{{ number_format(count($reports->where('is_complete',true))) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">{{ number_format(count($users->where('phone_number',!null))) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <p>&nbsp;</p>
        <div class="col-md-12">
            <div class="card border-secondary">
                <div class="card-body">
                    <!-- Chart's container -->
                    <div id="chart" style="height: 300px;"></div>
                    <!-- Charting library -->
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('dash_board_chart')",
        });
    </script>
@endsection
