@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/tablesaw-master/dist/tablesaw.css')}}" rel="stylesheet">
@endpush
@section('content')
    <section class="monthly_sales_repo">

        <div class="container-fluid">

            <div class="row white-box">
                <div class="col-md-12">
                    @can('view-'.str_slug('appointment'))
                        <a class="btn btn-success pull-right" href="javascript:history.back();">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>

                    @endcan
                </div>
                <div class="col-lg-6 col_left">
                    <div class="white-box whiteBox_left left_monthly_sale_report_table">
                        <table class="tablesaw table-bordered table-hover table">
                            <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Customer
                                </th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Total Leads</th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Stages</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                @$groupedLeadsByCustomer = $leads->groupBy('customer_id');
                            @endphp
                            @foreach ($groupedLeadsByCustomer as $customerId => $customerLeads)
                                @php
                                    @$customer = $customerLeads->first()->customer;
                                    @$customerName = $customer ? $customer->name : 'Unknown';
                                    @$customerLeadsCount = $customerLeads->count();
                                    @$groupedLeads = $customerLeads->groupBy('stage_id');
                                @endphp
                                <tr>
                                    <td class="title"><a href="javascript:void(0)">{{ $customerName }}</a></td>
                                    <td>{{ $customerLeadsCount }}</td>
                                    <td colspan="3">
                                        @foreach ($groupedLeads as $stageId => $stageLeads)
                                            @php
                                                $stage = $stageLeads->first()->getStage;
                                                $stageName = $stage ? $stage->name : 'Unknown';
                                            @endphp
                                            {{ $stageName }} ({{ $stageLeads->count() }}),
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            @if ($groupedLeadsByCustomer->isEmpty())
                                <tr>
                                    <td colspan="5">No Data Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col_right">
                    <div class="white-box whiteBox_right left_monthly_sale_report_table">
                        <table class="tablesaw table-bordered table-hover table">
                            <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Stages</th>
{{--                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"><abbr title="Rotten Tomato Rating">Stages Count</abbr></th>--}}
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Stages Count</th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($leads->groupBy('stage_id') as $stageId => $groupedLeads)
                                <tr>
                                    <td>{{ $groupedLeads->first()->getStage->name }}</td>
                                    <td>{{ $groupedLeads->count() }}</td>
                                    {{--                                    <td>$ {{ $groupedLeads->sum('lead_price') + $groupedLeads->getChangeOrder->where('status', 'approved')->sum('total_amount') }}</td>--}}
                                    <td>
                                        ${{ number_format(
    (float) ($groupedLeads->sum(fn($lead) => (float) ($lead->lead_price ?? 0))) +
    (float) ($groupedLeads->sum(fn($lead) => (float) ($lead->getChangeOrder->where('status', 'approved')->sum('total_amount') ?? 0)))
    , 2, '.', '') }}

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Data Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box table_box">
                        <div class="table-responsive sales_bigTbale">

                            <h3 class="box-title"> Duration </h3>
                            <div class="lead-scrollable-content">
                                <table id="myTable" class="table table-striped ">
                                    <thead>
                                    <tr>
                                        <th style="min-width: 100px" >Stages</th>
                                        <th>Lead</th>
                                        <th>Customer</th>
                                        <th>Started Date</th>
                                        <th>Won Date</th>
                                        <th>Location</th>
                                        <th>Notes</th>
                                        <th style="min-width: 100px" >Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($leads as $key => $lead)
                                        <tr>
                                            <td>{{$lead->getStage->name??"not available"}}</td>
                                            <td>{{$lead->title??"not available"}}</td>
                                            <td>{{$lead->customer->name??"not available"}}</td>
                                            <td> {{ $lead->lead_date ? (new DateTime($lead->lead_date))->format('F, d, Y') : "not available" }} </td>
                                            <td> {{ $lead->lead_status_date ? (new DateTime($lead->lead_status_date))->format('F, d, Y') : "not available" }} </td>
                                            <td>{{$lead->address??"not available"}}</td>
                                            <td>{!! substr($lead->other_information,0,100).'...' !!}</td>
                                            <td>
                                                ${{ number_format(
    (float) ($lead->lead_price ?? 0) +
    (float) ($lead->getChangeOrder->sum('total_amount') ?? 0)
    , 2, '.', '') }}

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"> No Data Found </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">
                            Revenue Result
                        </h3>
                        <p class="text-muted m-b-20">
                            comparing the estimated amounts with the leads provides valuable insights into the potential revenue and the effectiveness of our sales strategies
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Estimated Amount</th>
                                    <th>Estimated Month</th>
                                    <th>Progress</th>
                                    <th>Sales Revenue</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($yearEstimations as $estimation)
                                    @if($estimation->months->count() > 0)
                                        @foreach($estimation->months as $month)
                                            <tr>
                                                <td>${{ number_format($month->amount ?? 0, 2, '.', '') }}</td>

                                                <td>{{ $month->name ?? '' }}</td>
                                                <td>
                                                    @php
                                                        @$monthKey         = $month->name;
                                                        @$percentage       = $goalAchievementPercentages[$monthKey] ?? 0;
                                                        @$leadPrice        = $totalLeadPricePerMonth[$monthKey] ?? 0;
                                                        @$percentage       = min($percentage, 100);
                                                        @$progressBarWidth = max($percentage, 0); // Ensure width is not negative
                                                    @endphp
                                                    <div class="progress progress-xs margin-vertical-10">
                                                        <div class="progress-bar " style="width: {{ $progressBarWidth }}%"></div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($leadPrice, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="4">No Data estimated found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="white-box revenue_box">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h3> REVENUE </h3>
                        </div>
                        {{--<div class="col-md-8'>--}}
                        <canvas id="myBarChart" width="300px" height="200"></canvas>
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        {{--$(document).ready(function () {--}}
        {{--    var labels = [];--}}
        {{--    var goalData = [];--}}
        {{--    var actualData = [];--}}

        {{--    @foreach($yearEstimations as $estimation)--}}
        {{--    @if($estimation->months->count() > 0)--}}
        {{--    @foreach($estimation->months as $month)--}}
        {{--    labels.push("{{ $month->name }}");--}}
        {{--    goalData.push({{ $month->amount ?? 0 }});--}}
        {{--    @php--}}
        {{--        @$monthKey = $month->name;--}}
        {{--        @$leadPrice = $totalLeadPricePerMonth[$monthKey] ?? 0;--}}
        {{--    @endphp--}}
        {{--    actualData.push({{ $leadPrice }});--}}
        {{--    @endforeach--}}
        {{--    @endif--}}
        {{--    @endforeach--}}

        {{--    var data = {--}}
        {{--        labels: labels,--}}
        {{--        datasets: [{--}}
        {{--            label: "MY GOAL",--}}
        {{--            backgroundColor: "#74C911",--}}
        {{--            data: goalData,--}}
        {{--            borderColor: '#74C911',--}}
        {{--            borderWidth: 0,--}}
        {{--            borderSkipped: false,--}}
        {{--            barThickness: 15,--}}
        {{--            borderRadius: 20,--}}
        {{--        },{--}}
        {{--            label: "MY ACTUAL",--}}
        {{--            backgroundColor: "#4E7D18",--}}
        {{--            data: actualData,--}}
        {{--            borderColor: '#74C911',--}}
        {{--            borderWidth: 0,--}}
        {{--            borderSkipped: false,--}}
        {{--            barThickness: 15,--}}
        {{--            borderRadius: 20,--}}
        {{--        }]--}}
        {{--    };--}}

        {{--    var ctx = $("#myBarChart").get(0).getContext("2d");--}}
        {{--    var myBarChart = new Chart(ctx, {--}}
        {{--        type: 'bar',--}}
        {{--        data: data,--}}
        {{--        options: {--}}
        {{--            scales: {--}}
        {{--                yAxes: [--}}
        {{--                    {--}}
        {{--                        stacked: false,--}}
        {{--                        gridLines: {--}}
        {{--                            color: 'rgba(0,0,0,0 , .0)'--}}
        {{--                        },--}}
        {{--                        ticks: {--}}
        {{--                            beginAtZero: true,--}}
        {{--                            max: 40--}}
        {{--                        }--}}
        {{--                    }--}}

        {{--                ],--}}
        {{--                xAxes: [{--}}
        {{--                    barThickness: 10, // Adjust the width of the bars in pixels--}}
        {{--                    gridLines: {--}}
        {{--                        display: false--}}
        {{--                    },--}}
        {{--                    categorySpacing: 0,--}}
        {{--                }]--}}
        {{--            },--}}
        {{--            plugins: {--}}
        {{--                legend: {--}}
        {{--                    display: true,--}}
        {{--                    position: 'top',--}}
        {{--                    labels: {--}}
        {{--                        usePointStyle: true,--}}
        {{--                        color: '#838383'--}}
        {{--                    }--}}
        {{--                }--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $(document).ready(function () {
            var labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var goalData = Array(12).fill(0); // Initialize all months with 0
            var actualData = Array(12).fill(0); // Initialize all months with 0

            @foreach($yearEstimations as $estimation)
            @if($estimation->months->count() > 0)
            @foreach($estimation->months as $month)
            var monthIndex = labels.indexOf("{{ $month->name }}");
            if (monthIndex !== -1) {
                goalData[monthIndex] = {{ $month->amount ?? 0 }};
                @php
                    @$monthKey = $month->name;
                    @$leadPrice = $totalLeadPricePerMonth[$monthKey] ?? 0;
                @endphp
                    actualData[monthIndex] = {{ $leadPrice }};
            }
            @endforeach
            @endif
            @endforeach

            var data = {
                labels: labels,
                datasets: [{
                    label: "MY GOAL",
                    backgroundColor: "#74C911",
                    data: goalData,
                    borderColor: '#74C911',
                    borderWidth: 0,
                    borderSkipped: false,
                    barThickness: 15,
                    borderRadius: 20,
                }, {
                    label: "MY ACTUAL",
                    backgroundColor: "#4E7D18",
                    data: actualData,
                    borderColor: '#74C911',
                    borderWidth: 0,
                    borderSkipped: false,
                    barThickness: 15,
                    borderRadius: 20,
                }]
            };
            var ctx = $("#myBarChart").get(0).getContext("2d");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data, // Ensure 'data' is defined (see example below)
                options: {
                    scales: {
                        y: {
                            stacked: false,
                            grid: {
                                display: true, // Ensure y-axis grid lines are visible
                                color: 'rgba(0, 0, 0, 0.1)', // Light gray grid lines
                                lineWidth: 1 // Visible grid line thickness
                            },
                            ticks: {
                                beginAtZero: true,
                                max: 40,
                                callback: function(value) {
                                    return value.toFixed(2); // Y-axis labels in 1 decimal place (e.g., 0.0, 10.0)
                                }
                            }
                        },
                        x: {
                            barThickness: 10, // Width of bars in pixels
                            grid: {
                                display: false // No grid lines on x-axis
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                color: '#838383'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    var value = context.parsed.y;
                                    return label + ': ' + value.toFixed(2); // Tooltip values in 1 decimal place
                                }
                            }
                        }
                    }
                }
            });
        });

    </script>
@endpush
