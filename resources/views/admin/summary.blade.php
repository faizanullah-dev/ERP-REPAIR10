@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
    <section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5> Summary Performance Report </h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                            <ul>
                                <li class="borderRadius {{ request()->is('jobs_won') ? 'active' : '' }}"><a href="{{ url('jobs_won') }}">Jobs Won</a></li>
                                <li class="borderRadius {{ request()->is('performance') ? 'active' : '' }}"><a href="{{ url('performance') }}">Performance(#)</a></li>
                                <li class="borderRadius {{ request()->is('by_salesman') ? 'active' : '' }}"><a href="{{ url('by_salesman') }}">By Salesman</a></li>
                                <li class="borderRadius {{ request()->is('summary') ? 'active' : '' }}"><a href="{{ url('summary') }}">Summary</a></li>
                                <li class="borderRadius {{ request()->is('job_listings') ? 'active' : '' }} "><a href="{{ url('job_listings') }}">Job Listing(#)</a></li>
                            </ul>
                            <div class="advance_btn ml-auto">
                                <input class="form-control  borderRadius search_bar" id="search_bar" type="text" placeholder="Advance Search">
                            </div>
                        </div>
                        <div class="table_div"  style="overflow-x:auto;">
                            <table id="myTable" class="table table-borderless staff table-responsive">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> Salesman/Customer Rep</th>
                                    <th scope="col"> Leads </th>
                                    <th scope="col"> Proposal </th>
                                    <th scope="col"> Jobs Won </th>
                                    <th scope="col"> Jobs Lost </th>
                                    <th scope="col"> Jobs Success Amount </th>
                                    <th scope="col"> Change Order Amount </th>
                                    <th scope="col"> Total Sales </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($groupedLeads->count() > 0)
                                    @foreach ($groupedLeads as $repName => $groupedLeadsByRep)
                                        @php
                                            $totalLeadCount = $groupedLeadsByRep->count();
                                            $totalJobsWon = $groupedLeadsByRep->where('lead_status','won')->count();
                                            $totalJobsLost = $groupedLeadsByRep->where('lead_status','lost')->count();
                                            $totalLeadPrice = $groupedLeadsByRep->where('lead_status','won')->sum(function($lead) {
    return is_numeric($lead->lead_price_with_change_order_price) ? (float)$lead->lead_price_with_change_order_price : 0;
});

$totalLeadPriceAmount = $groupedLeadsByRep->where('lead_status','won')->sum(function($lead) {
    return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
});
                                            $totalChangeOrders = $groupedLeadsByRep->sum(function($lead) {
                                                return $lead->getChangeOrder->count();
                                            });
                                            $totalProposals = $groupedLeadsByRep->sum(function($lead) {
                                                return $lead->getProposal->count();
                                            });

                                            $totalChangeOrderAmount = $groupedLeadsByRep->sum(function($lead) {
                                                return $lead->getChangeOrder()->where('status', 'approved')->sum('total_amount');
                                            });

                                            $latestLead = $groupedLeadsByRep->sortByDesc('created_at')->first();
                                            $totalSalesAmount =  $totalLeadPriceAmount+$totalChangeOrderAmount;
                                        @endphp

                                        <tr>
                                            <th class="align-middle" scope="row">{{$loop->iteration??'0'}}</th>
                                            <td class="align-middle">{{  $repName??'unknown' }}</td>
                                            <td class="align-middle">{{  $totalLeadCount??'0' }}</td>
                                            <td class="align-middle">{{  $totalProposals??'0' }}</td>
                                            <td class="align-middle">{{  $totalJobsWon??'0' }}</td>
                                            <td class="align-middle">{{  $totalJobsLost??'0' }}</td>
                                            <td class="align-middle">${{ number_format($totalLeadPriceAmount, 2) }}</td>
                                            <td class="align-middle">${{ number_format($totalChangeOrderAmount, 2) }}</td>
                                            <td class="align-middle">${{ number_format($totalSalesAmount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr ><td colspan="4">No Data Found</td></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="white-box">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
    <script>
        $(document).ready(function() {
            var $originalRows = $('tbody tr');
            $('#search_bar').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                var $matchingRows = $originalRows.filter(function() {
                    return $(this).text().toLowerCase().indexOf(searchText) > -1;
                });
                $originalRows.hide();
                $matchingRows.show();
                if ($matchingRows.length === 0) {
                    if ($('#noRecordRow').length === 0) {
                        $('tbody').append('<tr id="noRecordRow"><td colspan="15" style="text-align:center;"><b>No Record Found</td></tr>');
                    }
                } else {
                    $('#noRecordRow').remove();
                }
            });
        });
        window.onload = function () {
            var options = {
                animationEnabled: true,
                title: {
                    text: "SUMMARY SALES PERFORMANCE"
                },
                axisY: {
                    title: "Summary of Sales",
                    valueFormatString: "$#,##0.0",
                },
                axisX: {
                    title: "CUSTOMERS"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "$#,##0.0",
                    dataPoints: [
                            @if($groupedLeads->count() > 0)
                            @foreach ($groupedLeads as $repName => $groupedLeadsByRep)
                            @php
                                $totalLeadCount = $groupedLeadsByRep->count();
                                $totalJobsWon = $groupedLeadsByRep->where('lead_status','won')->count();
                                $totalJobsLost = $groupedLeadsByRep->where('lead_status','lost')->count();
//                                $totalLeadPrice = $groupedLeadsByRep->where('lead_status','won')->sum('lead_price');
                                $totalLeadPriceAmount = $groupedLeadsByRep->where('lead_status','won')->sum(function($lead) {
    return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
});
                                $totalChangeOrders = $groupedLeadsByRep->sum(function($lead) {
                                    return $lead->getChangeOrder->count();
                                });
                                $totalProposals = $groupedLeadsByRep->sum(function($lead) {
                                    return $lead->getProposal->count();
                                });

                                $totalChangeOrderAmount = $groupedLeadsByRep->sum(function($lead) {
                                    return $lead->getChangeOrder()->where('status', 'approved')->sum('total_amount');
                                });

                                $totalSalesAmount = $totalChangeOrderAmount + $totalLeadPriceAmount;
                                $latestLead = $groupedLeadsByRep->sortByDesc('created_at')->first();
                            @endphp
                        { label: "{{ $repName }}", y: {{ $totalSalesAmount }} },

                        @endforeach
                        @endif
                    ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);
        }

    </script>

@endpush