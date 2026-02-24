@extends('layouts.master')
@section('content')
    <section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Sales Weekly</h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                            <ul>
                                <li class="borderRadius {{ request()->is('appointment_report_table') ? 'active' : '' }}"><a href="{{ url('appointment_report_table?year=' . ( $year ?? date('Y'))) }}">Appointment Report Table</a></li>
                                <li class="borderRadius {{ request()->is('appointment_report_table_first') ? 'active' : '' }}"><a href="{{ url('appointment_report_table_first?year=' . ( $year ?? date('Y'))) }}">Appointment Report Table First</a></li>
                                <li class="borderRadius {{ request()->is('sales_weekly') ? 'active' : '' }}"><a href="{{ url('sales_weekly?year=' . ( $year ?? date('Y'))) }}">Sales Weekly</a></li>
                                <li class="borderRadius {{ request()->is('appointment_per_day') ? 'active' : '' }}"><a href="{{ url('appointment_per_day?year=' . ( $year ?? date('Y'))) }}">Appointment Per Day</a></li>
                            </ul>
                            <div class="advance_btn ml-auto">
                                <form>
                                    <select class="form-control clr_input_fields borderRadius select2" id="year_filter" name="year">
                                        <option value="" {{ request()->get('year') == '' ? 'selected hidden' : '' }}>Year</option>
                                        @foreach($years as $year)
                                            <option value="{{$year->year}}" {{ request()->get('year') == $year->year ? 'selected' : '' }}>{{$year->year}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="table_div"  style="overflow-x:auto;">
                            <table class="table table-borderless staff table-responsive">
                                <thead>
                                <tr>
                                    <th>Week <br> <strong style="color: black; font-size: larger;">Totals</strong> </th>
                                    <th></th>
                                    <th>JOBS <br> <strong style="color: black; font-size: larger;">{{$yearLeadCount??''}}</strong> </th>
                                    <th>Jobs Revenue <br> <strong style="color: black; font-size: larger;">${{ $formattedyearlyleadprice ?? 'Not Available' }}</strong></th>
                                    <th>Won Jobs Reached <br> <strong style="color: black; font-size: larger;">{{ $WonLeadCount ?? 'Not Available' }}</strong></th>
                                    <th>Won Jobs Revenue Reached <br> <strong style="color: black; font-size: larger;">${{ $formattedWonLeadPriceSum ?? 'Not Available' }}</strong></th>
                                    <th><br> <strong style="color: black; font-size: larger;">${{ $totalMonthlyLeadPriceFormatted ?? 'Not Available' }}</strong></th>
                                    <th> <br> <strong style="color: red; font-size: larger;">${{$totalMonthlyLeadPriceDifferenceFormatted}}</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($weeklyData as $index => $weekData)
                                        <tr>
                                            <td class="align-middle">Week {{ $weekData['week'] }}</td>
                                            <td class="align-middle">{{ $weekData['startDate'] }} - {{ $weekData['endDate'] }}</td>
                                            <td class="align-middle">{{ $weekData['leadCount'] == 0 ? '-' : ($weekData['leadCount'] ?? 'Not Available') }}</td>
                                            <td class="align-middle">{{ $weekData['formattedTotalLeadPrice'] == 0 ? '-' : ($weekData['formattedTotalLeadPrice'] == 'Not Available' ? $weekData['formattedTotalLeadPrice'] : '$'.$weekData['formattedTotalLeadPrice']) }}</td>
                                            <td class="align-middle">{{ $weekData['totalWonLeadPriceCount'] == 0 ? '-' : ($weekData['totalWonLeadPriceCount'] ?? 'Not Available') }}</td>
                                            <td class="align-middle">{{ $weekData['formattedTotalWonLeadPrice'] == 0 ? '-' : ($weekData['formattedTotalWonLeadPrice'] == 'Not Available' ? $weekData['formattedTotalWonLeadPrice'] : '$'.$weekData['formattedTotalWonLeadPrice']) }}</td>
                                            @if(($index + 1) < count($weeklyData) && Carbon\Carbon::parse($weeklyData[$index + 1]['startDate'])->month != Carbon\Carbon::parse($weekData['startDate'])->month || $index == count($weeklyData) - 1)
                                                <td class="align-top">{{ isset($monthlyTotalLeadPriceFormatted[Carbon\Carbon::parse($weekData['startDate'])->month]) ? '$'.$monthlyTotalLeadPriceFormatted[Carbon\Carbon::parse($weekData['startDate'])->month] : '-' }}<br></td>
                                            @else
                                                <td class="align-middle"></td>
                                            @endif
                                            @if (($index + 1) < count($weeklyData) && Carbon\Carbon::parse($weeklyData[$index + 1]['startDate'])->month != Carbon\Carbon::parse($weekData['startDate'])->month || $index == count($weeklyData) - 1)
                                                <td class="align-middle">
                                                    {{ isset($monthlyTotalLeadWonPriceFormatted[Carbon\Carbon::parse($weekData['startDate'])->month]) ? '$'.$monthlyTotalLeadWonPriceFormatted[Carbon\Carbon::parse($weekData['startDate'])->month] : '-' }}
                                                    <br>
                                                    <strong style="color: red; font-size: small;">
                                                        @if (($index + 1) < count($weeklyData) && Carbon\Carbon::parse($weeklyData[$index + 1]['startDate'])->month != Carbon\Carbon::parse($weekData['startDate'])->month || $index == count($weeklyData) - 1)
                                                            {{ isset($leadSubstractLeadWonFormatted[Carbon\Carbon::parse($weekData['startDate'])->month]) ? '$'.$leadSubstractLeadWonFormatted[Carbon\Carbon::parse($weekData['startDate'])->month] : '-' }}
                                                            <br>
                                                            <strong style="color: red; font-size: small;"></strong>
                                                        @endif
                                                    </strong>
                                                </td>
                                            @else
                                                <td class="align-middle"></td>
                                            @endif
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                       </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center" >
                    <div class="col-md-12 m-4">
                        <h3> Weekly Sales # of Jobs </h3>
                        <canvas id="myBarChartSalesWeeklyJobs" width="500" height="300"></canvas>
                    </div>
                </div>
                <div class="d-flex justify-content-center" >
                    <div class="col-md-12 m-4">
                        <h3> Weekly Sales $$$ </h3>
                        <canvas id="myBarChartSalesWeekly" width="600" height="400"></canvas>
                    </div>
                </div>
                <div class="table-responsive weekly_sales_table">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Week</th>
                            @for($week = 1; $week <= 52; $week++)
                                <th>Week {{ $week }}</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Goal</td>
                            @foreach($weeklyData as $index => $weekData)
                                <td class="custom_td_view">{{ $weekData['formattedTotalLeadPrice'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Actual</td>
                            @foreach($weeklyData as $index => $weekData)
                                <td class="custom_td_view">{{ $weekData['formattedTotalWonLeadPrice'] }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> <!-- Include Chart.js library -->
<script>
    $(document).ready(function() {
        $('#year_filter').change(function() {
            var selectedYear = $(this).val();
            var currentYear = selectedYear;
            $('#current_year').text(currentYear);
            $(this).closest('form').submit();
        });
    });

    var myGoalData = [];
    var myActualData = [];
    var labels = [];

    $(document).ready(function () {

        @foreach($weeklyData as $weekData)
        myGoalData.push({{$weekData['leadCount']}});
        myActualData.push({{$weekData['totalWonLeadPriceCount']}});
        labels.push("{{date('M d', strtotime($weekData['startDate']))}} - {{date('M d', strtotime($weekData['endDate']))}}");
        @endforeach

        var data = {
            labels: labels,
            datasets: [{
                label: "MY GOAL",
                backgroundColor: "#74C911",
                data: myGoalData,
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
                usePointStyle: true
            },{
                label: "MY ACTUAL",
                backgroundColor: "#4E7D18",
                data: myActualData,
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
                usePointStyle: true
            }]
        };

        var ctx = $("#myBarChartSalesWeeklyJobs").get(0).getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        ticks: {
                            beginAtZero: true
                        }
                    },
                    x: {
                        gridLines: {
                            drawTicks: false,
                            display: false,
                            drawBorder: false,
                        },
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
                    }
                }
            }
        });
    });



    $(document).ready(function () {

        var myGoalPrices = [];
        var myActualPrices = [];
        var labels2 = [];

        @foreach($weeklyData as $index => $weekData2)

        myGoalPrices.push("{{$weekData2['totalLeadPrice']}}");
        myActualPrices.push("{{$weekData2['totalWonLeadPrice']}}");
        labels2.push("Week {{$index + 1}} ({{date('M d', strtotime($weekData2['startDate']))}} - {{date('M d', strtotime($weekData2['endDate']))}})");
        @endforeach

        var data2 = {
            labels: labels2,
            datasets: [{
                label: "GOAL PRICE",
                backgroundColor: "#74C911",
                data: myGoalPrices,
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
                usePointStyle: true
            },{
                label: "ACTUAL PRICE",
                backgroundColor: "#4E7D30",
                data: myActualPrices,
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
                usePointStyle: true
            }]
        };

        var ctx2 = $("#myBarChartSalesWeekly").get(0).getContext("2d");
        var myBarChart2 = new Chart(ctx2, {
            type: 'bar',
            data: data2,
            options: {
                scales: {
                    y: {
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return '$' + value; // Add '$' sign before the value
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: true,
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
                    }
                }
            }
        });
    });

</script>

@endpush
