@extends('layouts.master')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
{{--            <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Year Goal') }} {{ $yearestimation->year }}</h3>--}}
            @can('view-'.str_slug('YearEstimation'))
                <a class="btn btn-success pull-right" href="{{ url('/yearEstimation/year-estimation') }}">
                    <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
            @endcan
            <div class="clearfix"></div>
            <hr>

            <div class="row">
                <div class="col-md-6">
                <h2 class="text-center">LEADUP GOAL FOR {{$yearestimation->year??'00'}}</h2>
            </div>
                <div class="col-md-6">
                <h2 class="text-center">LEADUP REAL PRODUCTION FOR {{ $yearestimation->year }}</h2>
            </div>
                <div class="col-md-6">
                <h4>Sheet</h4>
                <table class="table table-bordered">
                    <tr>
                        <th> Target Leads </th>
                        <th> Targeted Jobs </th>
                        <th> Gross Income </th>
                    </tr>
                    <tr>
                        <td id="target_lead_id"> </td>
                        <td id="targeted_jobs">
{{--                            {{ $yearestimation->year }}--}}
                        </td>
                        <td class="gross_income"> {{ number_format($yearestimation->estimate_amount ?? 0, 2) }} </td>

                    </tr>
                    <tr>
                        <th> Yearly if each job is:</th>
                        <th> Expected Gross % P/job </th>
                        <th> Expected Gross </th>
                    </tr>
                    <tr>
                        <td>{{ number_format ($yearestimation->amount_per_job ?? 0, 2) }}</td>
                        <td> {{ number_format($yearestimation->job_convertion_ratio ?? 0, 2) }} %</td>
                        <td> {{ number_format($expectedGross ?? 0, 2) }} </td>
                    </tr>
                    <tr>
                        <th> Squares to be produced Yearly :</th>
                        <th> Squares to be produced Weekly :</th>
                        <th> Weekly                        :</th>
                    </tr>
                    <tr>
                        <td> {{ number_format($producedYearly) }} </td>
                        <td> {{ number_format($producedWeekly) }} </td>
                        <td> {{$yearestimation->extra_push}} working weeks on a year </td>
                    </tr>

                </table>

            </div>
                <div class="col-md-6">
                <h4>Sheet</h4>
                <table class="table table-bordered">
                    <tr>
                        <th> Targeted Leads </th>
                        <th> Success Lead  </th>
                        <th> Gross Income </th>
                    </tr>
                    <tr>
                        <td id="production_targeted_leads">
{{--                            {{  $yearestimation->year }}--}}
                        </td>
                        <td id="suceess_lead">  </td>
                        <td> {{ number_format($finalProductionEarn ?? 0, 2) }} </td>

                    </tr>
                    <tr>
                        <th>Yearly if each job is:</th>
                        <th>Expected Gross % P/job</th>
                        <th>Expected Gross</th>
                    </tr>
                    <tr>
                        <td id="yearly_if_job">
{{--                            {{ number_format($yearestimation->amount_per_job) }} --}}

                        </td>
                        <td id="expected_gross_percentage">
{{--                            {{ number_format($yearestimation->job_convertion_ratio) }} %--}}
                        </td>
                        <td> {{ number_format($ProductionExpectedGross ?? 0, 2) }} </td>

                    </tr>
                    <tr>
                        <th>Squares to be produced Yearly:</th>
                        <th>Squares to be produced Weekly:</th>
                        <th>Weekly:</th>
                    </tr>
                    <tr>
                        <td>{{ number_format($leadProductedYearly) }}</td>
                        <td>{{ number_format($leadProductedWeekly) }}</td>
                        <td>{{$yearestimation->extra_push}} working weeks on a year</td>
                    </tr>
                </table>
            </div>
                <div class="col-md-12">
                    <h4 id="advertise_budget">Advertising Budget 4 % off  Gross  :  </h4>
                </div>
                <div class="col-md-6">
                    <div class="monthly_sold_text">
                        <h4>Monthly Sold</h4><span>Monthly Income Needed to stay on Budget ( based on avg % of Sales per Month Historically)</span>
                    </div>
                    <div class="table-responsive left_monthly_sale_report_table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                {{--                            <th style="max-width: 200px; text-overflow: ellipsis; overflow: hidden;  white-space: nowrap; " >Monthly Income Needed to stay on Budget ( dased on avg % of Sales per Month Historically</th>--}}
                                <th></th>
                                <th></th>
                                <th>{{ number_format($yearestimation->job_convertion_ratio) }}%</th>
                                <th>Leads Needed</th>
                                <th>40%</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $totalPercentage         = 0;
                                $totalAmount             = 0;
                                $totalMonthRequiredLeads = 0;
                                $totalMonthNeededLeads   = 0;
                                $totalExtraLeads         = 0;
                                $totalextraAmount        = 0;
                            @endphp
                            @if($yearestimation->months->count() > 0)
                                @foreach($yearestimation->months as $key => $estimation)
                                    @php
                                        $totalPercentage += $estimation->percentage;
                                        $totalAmount += $estimation->amount;
                                        $totalMonthRequiredLeads += $estimation->month_required_leads;
                                        $totalMonthNeededLeads += $estimation->month_needed_leads;
                                        $totalExtraLeads += $estimation->extra_leads;
                                        $totalextraAmount += $estimation->extra_amount;
                                    @endphp
                                    <tr>
                                        <td> {{ number_format($estimation->percentage, 2) }}% </td>
                                        <td> {{  $estimation->name ?? 'Month' }} </td>
                                        <td> ${{ number_format($estimation->amount ?? 0, 2) }} </td>
                                        <td> {{ number_format(round($estimation->month_required_leads), 2) }} </td>
                                        <td> {{$estimation->month_needed_leads }} </td>
                                        <td>{{ number_format($estimation->extra_leads ?? 0, 2) }}</td>
                                        <td> ${{ number_format($estimation->extra_amount ?? 0, 2) }} </td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td>{{ number_format ($totalPercentage ?? 0, 2) }}%</td>
                                    <td> </td>
                                    <td> ${{ number_format($totalAmount ?? 0, 2) }} </td>
                                    <td id="table_total_leads"> {{ number_format($totalMonthRequiredLeads ?? 0, 2) }} </td>
                                    <td id="target_lead"> {{ number_format($totalMonthNeededLeads ?? 0, 2) }} </td>
                                    <td>{{ number_format($totalExtraLeads ?? 0, 2) }}</td>
                                    <td> $ {{ number_format($totalextraAmount ?? 0, 2) }} </td>

                                </tr>
                            @else
                                <tr>
                                    <td colspan="7">No Data Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Monthly Sold</h4>
                    <div class="table-responsive left_monthly_sale_report_table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th> Monthly Sold </th>
                                <th> Jobs Sold % </th>
                                <th id="divide_job_sold_or_actual_leads">  </th>
                                <th> Actual Leads</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($monthlyLeads))
                                @php
                                    $totalPercentage          = 0;
                                    $totalAmountLead          = 0;
                                    $totalJobSold             = 0;
                                    $totalactualLeadscount    = 0;
                                @endphp
                                @foreach($monthlyLeads as $month => $monthlyLead)
                                    @php
                                        $percentages      = $monthlyLead['total'] > 0 ? ($monthlyLead['total'] / $finalProductionEarn) * 100 : 0;
                                        $totalPercentage += $percentages > 0 ? $percentages : 0;
                                        $totalAmountLead += $monthlyLead['total'] > 0 ?  $monthlyLead['total'] : 0;
                                        $totalJobSold    += $monthlyLead['count'] > 0 ? $monthlyLead['count'] : 0;
                                        $totalactualLeadscount    += $monthlyLead['actualLeadscount'] > 0 ? $monthlyLead['actualLeadscount'] : 0;

                                    @endphp
                                    <tr>
                                        <td> {{ number_format($percentages, 2) }}%</td>
                                        <td>  {{ $month }}  </td>
                                        <td>$ {{ number_format($monthlyLead['total'] ?? 0, 2) }} </td>
                                        <td> {{ number_format($monthlyLead['count'] ?? 0, 2) }} </td>
                                        <td> {{ number_format($monthlyLead['count'] / ($monthlyLead['actualLeadscount'] ?: 1), 2) }}</td>
                                        <td> {{ $monthlyLead['actualLeadscount'] }} </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td> {{ number_format($totalPercentage, 2) }}% </td>
                                    <td>  </td>
                                    <td>$ {{ number_format($totalAmountLead, 2) }} </td>
                                    <td id="totalJobSold"> {{ number_format($totalJobSold ?? 0, 2) }} </td>
                                    <td>  </td>
                                    <td id="totalactualLeadscount"> {{ number_format($totalactualLeadscount ?? 0, 2) }} </td>
                                </tr>

                            @else
                                <tr>
                                    <td colspan="6">No Data Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6" >
                    <h3> REVENUE </h3>
                    <canvas id="myBarChart" width="500" height="300"></canvas>
                </div>
                <div class="col-md-6 ">
                    <h3> LEADS </h3>
                    <canvas id="myBarChartLeads" width="500" height="300"></canvas>
                </div>
                <div class="col-md-12">
                    <h3> Sold Jobs </h3>
                    <canvas id="myBarChartJobSold" width="500" height="300"></canvas>
                </div>
            </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function(){
    var grossText = $('.gross_income').text().trim();
    var gross = parseFloat(grossText.replace(/[^0-9.]/g, ''));
    var grossIncome = gross * 0.04;
    $('#advertise_budget').text("Advertising Budget 4 % off Gross: " + grossIncome.toFixed(0));
});
// ========================================================revenue Chart============================================
var ctx = $("#myBarChart").get(0).getContext("2d");
$(document).ready(function () {
    var data = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "MY GOAL",
            backgroundColor: "#74C911",
            data: [
                @if($yearestimation->months->count() > 0)
                        @foreach($yearestimation->months as $index => $estimation)
                        {{ $estimation->amount  }}@if(!$loop->last),@endif
                @endforeach
                @endif
            ],
            borderColor: '#74C911',
            borderWidth: 0,
            borderSkipped: false,
            barThickness: 15,
            borderRadius: 20,
        },{
            label: "MY ACTUAL",
            backgroundColor: "#4E7D18",
            data: [
                @if(!empty($monthlyLeads))
                        @foreach($monthlyLeads as $month => $monthlyLead)
                        {{ $monthlyLead['total']  }} @if(!$loop->last),@endif
                @endforeach
                @endif
            ],

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
        data: data,

        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            // Format the y-axis tick labels as decimals
                            return value.toFixed(2);  // Change to 2 decimals
                        }
                    }
                },
                x: {
                    barThickness: 10, // Adjust the width of the bars in pixels
                    gridLines: {
                        display: false
                    },
                    categorySpacing: 0,
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
                    enabled: true,  // Ensure tooltips are enabled
                    callbacks: {
                        label: function(tooltipItem) {
                            // Format the tooltip value as decimals
                            return tooltipItem.raw.toFixed(2); // Adjust to decimal format and add '%'
                        }
                    }
                }
            }
        }
    });
});





// -------------------------------------------------------------------------------------------------------------




// ========================================================revenue Chart end============================================







// ========================================================lead Chart start============================================



var ctx = $("#myBarChartLeads").get(0).getContext("2d");


    $(document).ready(function () {
        var data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "MY GOAL",
                backgroundColor: "#74C911",
                data: [
                    @if($yearestimation->months->count() > 0)
                    @foreach($yearestimation->months as $index => $estimation)
                    {{ $estimation->month_needed_leads ??'0' }} @if(!$loop->last),@endif
                    @endforeach
                    @endif
                ],
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
            },{
                label: "MY ACTUAL",
                backgroundColor: "#4E7D18",
                data: [
                    @if(!empty($monthlyLeads))
                    @foreach($monthlyLeads as $month => $monthlyLead)
                    {{ $monthlyLead['actualLeadscount'] }} @if(!$loop->last),@endif
                    @endforeach
                    @endif
                ],
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
            }]
        };




        var ctx = $("#myBarChartLeads").get(0).getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        borderWidth: 0,
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
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






// ========================================================lead Chart end============================================



// ========================================================sold Chart start============================================


var ctx = $("#myBarChartJobSold").get(0).getContext("2d");

    $(document).ready(function () {
        var data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "MY GOAL",
                backgroundColor: "#74C911",
                data: [
                    @if($yearestimation->months->count() > 0)
                    @foreach($yearestimation->months as $index => $estimation)
                    {{ $estimation->month_required_leads ??'0' }} @if(!$loop->last),@endif
                    @endforeach
                    @endif
                ],
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
                usePointStyle: true
            },{
                label: "MY ACTUAL",
                backgroundColor: "#4E7D18",
                data: [
                    @if(!empty($monthlyLeads))
                    @foreach($monthlyLeads as $month => $monthlyLead)
                    {{ $monthlyLead['count'] }} @if(!$loop->last),@endif
                    @endforeach
                    @endif
                ],
                borderColor: '#74C911',
                borderWidth: 0,
                borderSkipped: false,
                barThickness: 15,
                borderRadius: 20,
                usePointStyle: true
            }]
        };




        var ctx = $("#myBarChartJobSold").get(0).getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawTicks: false,
                            display: false,
                            drawBorder: false,
                        },
                    }]
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
    var totalJobSold = parseFloat($('#totalJobSold').text()) || 0;
    var totalactualLeadscount = parseFloat($('#totalactualLeadscount').text()) || 0;
    var totalJobSoldPercentage = 0;

    if (totalactualLeadscount !== 0) {
        totalJobSoldPercentage = totalJobSold / totalactualLeadscount;
    }

    $('#divide_job_sold_or_actual_leads').text(totalJobSoldPercentage.toFixed(2) + '%');

    var targetLead = parseFloat($('#target_lead').text()) || 0;
    $('#target_lead_id').text(targetLead.toFixed(2));
    $('#suceess_lead').text(totalJobSold.toFixed(2));

    var yearly_if_job = 0;
    if (totalJobSold !== 0) {
        yearly_if_job = {{ $finalProductionEarn }} / totalJobSold;
    }
    $('#yearly_if_job').text(yearly_if_job.toFixed(2));

    var production_targeted_leads = parseFloat(`{{ $totalactualLeadscount ?? 0 }}`) || 0;
    var expected_gross_percentage = 0;
    if (production_targeted_leads !== 0) {
        expected_gross_percentage = (totalJobSold / production_targeted_leads) * 100;
    }
    $('#expected_gross_percentage').text(expected_gross_percentage.toFixed(2) + '%');
    $('#production_targeted_leads').text(production_targeted_leads.toFixed(2));

    var targeted_jobs = parseFloat($('#table_total_leads').text()) || 0;
    $('#targeted_jobs').text(targeted_jobs.toFixed(2));
});



// ========================================================sold Chart end============================================


</script>
@endpush
