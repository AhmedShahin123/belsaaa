@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    {{ __('strings.backend.dashboard.last_week_tasks') }}
                </div><!--card-header-->
                <div class="card-body">
                    <canvas data-chart-data="{{json_encode($lastWeekTasks)}}" id="last-week-chart" width="400" height="400"></canvas>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
                <div class="card-body">
                    {!! __('strings.backend.welcome') !!}
                    <canvas data-chart-data="{{json_encode($tasksChartData)}}" id="myChart" width="400" height="400"></canvas>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('strings.backend.dashboard.last_month_tasks') }}
                </div><!--card-header-->
                <div class="card-body">
                    <canvas data-chart-data="{{json_encode($lastMonthTasks)}}" id="last-month-chart" width="400" height="400"></canvas>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('strings.backend.dashboard.last_year_tasks') }}
                </div><!--card-header-->
                <div class="card-body">
                    <canvas data-chart-data="{{json_encode($lastYearTasks)}}" id="last-year-chart" width="400" height="400"></canvas>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
    <script !src="">
        var ctx = document.getElementById('myChart');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: $('#myChart').data('chartData'),
            options: {

            }
        });

        var lastWeekCtx = document.getElementById('last-week-chart');
        var myPieChart = new Chart(lastWeekCtx, {
            type: 'line',
            data: $('#last-week-chart').data('chartData'),
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        var lastMonthCtx = document.getElementById('last-month-chart');
        var lastMonthChart = new Chart(lastMonthCtx, {
            type: 'line',
            data: $('#last-month-chart').data('chartData'),
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        var lastYearCtx = document.getElementById('last-year-chart');
        var lastYearChart = new Chart(lastYearCtx, {
            type: 'line',
            data: $('#last-year-chart').data('chartData'),
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            }
        });


    </script>
@endpush
