@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
@endpush
@section('content')
<section class="jobs_won mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                    <div class="card-headerr bg-white">
                        <h5>Job Won Report</h5>
                    </div>
                    <div class="hr-line mt-2"></div>
                    <div class="report_tabs">
                        <ul>
                            <li class="borderRadius colored_btn {{ request()->is('jobs_won') ? 'active' : '' }}"><a href="{{ url('jobs_won') }}">Jobs Won</a></li>
                            <li @if(request()->is('performance')) active @endif class="borderRadius"><a href="{{url('performance')}}">Performance(#)</a></li>
                            <li class="borderRadius"><a href="{{ url('by_salesman') }}">By Salesman</a></li>
                            <li class="borderRadius"><a href="{{ url('summary') }}">Summary</a></li>
                            <li class="borderRadius"><a href="{{ url('job_listings') }}">Job Listing(#)</a></li>
                        </ul>
                    </div>
                    <div class="white-box">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                    <div class="report_tabs">
                        <ul>
                            <li class="borderRadius colored_btn {{ request()->query('filter') == 'week' ? 'active' : '' }}">
                                <a href="{{ url('jobs_won?filter=week') }}">Week</a>
                            </li>
                            <li class="borderRadius colored_btn {{ request()->query('filter') == 'month' ? 'active' : '' }}">
                                <a href="{{ url('jobs_won?filter=month') }}">Month</a>
                            </li>
                            <li class="borderRadius colored_btn {{ request()->query('filter') == 'year' ? 'active' : '' }}">
                                <a href="{{ url('jobs_won?filter=year') }}">Year</a>
                            </li>
                        </ul>
                    </div>
                <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                    <div class="card-body bg-white">
                        <div class="report_form_fields">
                            <form id="filter-form" method="get" action="{{url('jobs_won')}}">
                                <div class="report_form_fields">
                                    <div class="mb-3">
                                        <label for="select-duration" class="form-label input_labels p-18">Select Duration Starts</label>
                                        @php
                                            if (request()->get('duration_starts') && request()->get('duration_ends')) {
                                                $yearEstimation = (object) [
                                                    'year' => request()->get('duration_starts')
                                                ];
                                                $durationEnds = request()->get('duration_ends');
                                            } else {
                                                $durationEnds = now()->endOfYear()->format('Y-m-d');
                                            }
                                        @endphp
                                        <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_starts"  value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" id="duration">
{{--                                            <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_starts" min="{{ $yearEstimation->year . now()->format('-m-d') }} value="{{request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" id="duration">--}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="select-duration" class="form-label input_labels p-18">Select Duration Ends</label>
                                        <input type="date" placeholder="End Date" class="form-control clr_input_fields borderRadius" name="duration_ends"  value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}" id="duration_ends">
{{--                                        <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_ends" value="{{request()->get('duration_ends')}}" id="duration">--}}

                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label input_labels p-18">Division</label>
                                        <select class="form-control  select2 borderRadius" name="category_id" id="category_id"  >
                                            <option value="">--Select Division--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label input_labels p-18">Customer Type</label>
                                        <select class="form-control  select2 borderRadius" name="customerType_id" id="customerType_id"  >
                                            <option value="">--Select CustomerType --</option>
                                            @foreach ($customerTypes as $customerType)
                                                <option value="{{$customerType->id}}" {{request()->get('customerType_id')== $customerType->id ? 'selected' : '' }}>{{$customerType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label input_labels p-18">User</label>
                                        <select class="form-control  select2 borderRadius" name="customer_id" id="customer_id" >
                                            <option  value=""  >--Select User--</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}" {{ request()->get('customer_id') == $customer->id ? 'selected' : '' }}>{{$customer->name??''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="reset_apply_btn">
                                        <a href="{{url('jobs_won')}}" class="btn border_btns borderRadius gray_btn">Reset</a>
                                            <button type="submit" class="btn border_btns borderRadius apply_filter blue_btn"  onclick="this.disabled = true; this.form.submit();">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bottom-para mt-3 p-3">
                    <p class="p-16">The graph represents the no. of jobs that were moved to <span
                                class="green_text p-16">"Signed Contract"</span> Stage (i.e. Jobs Won) in a specific time
                        frame for the Company.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Salesman / Customer Rep & Job Rep / Estimator -->
    <section class="customer_job_report mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr white-bg border-0">
                            <h5>Customer Rep & Job Rep</h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="card-body table_div">
                            {{--                        <p class="p-18">Duration: 01/01/2022 - 09/07/2022</p>--}}
                            <div class="table_wrapper_div table-responsive">
                                <table class="table table-borderless main_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer Rep</th>
                                        <th scope="col">Lead(#)</th>
                                        <th scope="col">Amount
                                            <table class="nested_table">
                                                <thead>
                                                <tr>
                                                    <th>Job Total Amount</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        <th scope="col">Change Orders
                                            <table class="nested_table">
                                                <thead>
                                                <tr>
                                                    <th>Change Orders(#)</th>
                                                    <th>Total Charge Order Amount</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        <th scope="col">Job Date</th>
                                        <th scope="col">Total Sales $</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @if($groupedLeads->count() > 0)
                                    @foreach ($groupedLeads as $repName => $groupedLeadsByRep)
                                        @php
                                            $totalLeadCount = $groupedLeadsByRep->where('lead_status','won')->count();
                                            $totalLeadPrice = $groupedLeadsByRep->sum(function($lead) {
                                                return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                                            });
                                            $totalLeadPriceAmount = $groupedLeadsByRep->where('lead_status','won')->sum(function($lead) {
                                                return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                                            });
                                            $totalChangeOrders = $groupedLeadsByRep->sum(function($lead) {
                                                return $lead->getChangeOrder()->where('status','approved')->count();
                                            });
                                            $totalChangeOrderAmount = $groupedLeadsByRep->sum(function($lead) {
                                                return $lead->getChangeOrder()->where('status','approved')->sum('total_amount');
                                            });
                                            $latestLead = $groupedLeadsByRep->sortByDesc('lead_status_date')->first();
                                        @endphp
                                        <tr>
                                            <th class="align-middle" scope="row"> {{ $loop->iteration }}</th>
                                            <td class="align-middle">{{ $repName }}</td>
                                            <td class="align-middle">{{ $totalLeadCount }}</td>
                                            <td class="align-middle">
                                                <table class="nested_table">
                                                    <tbody>
                                                    <tr>
                                                        <td>$ {{ number_format($totalLeadPriceAmount, 2) }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="align-middle">
                                                <table class="nested_table">
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $totalChangeOrders }}</td>
                                                        <td>$ {{ number_format($totalChangeOrderAmount, 2) }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="align-middle">
                                                {{ \Carbon\Carbon::parse($latestLead->lead_status_date ?? '')->format('m-d-Y') ?? 'Not Available' }}
                                            </td>
                                            <td class="align-middle">$ {{ number_format( $totalLeadPriceAmount + $totalChangeOrderAmount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                   @else
                                       <tr><td colspan="5">No Data Found</td></tr>
                                   @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
        <script>
                $(document).ready(function () {
                // Pass `yearEstimation->year` dynamically from the backend
                const yearEstimationYear = {{ $yearEstimation->year ?? 'new Date().getFullYear()' }};

                const urlParams = new URLSearchParams(window.location.search);
                const filter = urlParams.get("filter");

                // Utility function to format dates as YYYY-MM-DD
                const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Ensure 2 digits
                const day = String(date.getDate()).padStart(2, '0'); // Ensure 2 digits
                return `${year}-${month}-${day}`;
            };

                if (filter === "week") {
                // Use yearEstimationYear for the year
                const today = new Date();
                const day = today.getDay();
                const diffToMonday = day === 0 ? -6 : 1 - day; // Adjust to get the correct Monday
                const monday = new Date(yearEstimationYear, today.getMonth(), today.getDate() + diffToMonday);
                const sunday = new Date(monday.getFullYear(), monday.getMonth(), monday.getDate() + 6);

                // Set the Monday and Sunday dates
                $(".report_form_fields input[name='duration_starts']").val(formatDate(monday));
                $(".report_form_fields input[name='duration_ends']").val(formatDate(sunday));
                console.log("Monday: ", monday);
                console.log("Sunday: ", sunday);
            } else if (filter === "month") {
                // Use yearEstimationYear for the year
                const today = new Date();
                const firstDay = new Date(yearEstimationYear, today.getMonth(), 1);
                const lastDay = new Date(yearEstimationYear, today.getMonth() + 1, 0);

                // Set the first and last days of the month
                $(".report_form_fields input[name='duration_starts']").val(formatDate(firstDay));
                $(".report_form_fields input[name='duration_ends']").val(formatDate(lastDay));
                console.log("First Day: ", firstDay);
                console.log("Last Day: ", lastDay);
            } else if (filter === "year") {
                // Use yearEstimationYear for the year
                const firstDay = new Date(yearEstimationYear, 0, 1); // Jan 1st
                const lastDay = new Date(yearEstimationYear, 11, 31); // Dec 31st

                // Set the first and last days of the year
                $(".report_form_fields input[name='duration_starts']").val(formatDate(firstDay));
                $(".report_form_fields input[name='duration_ends']").val(formatDate(lastDay));
                console.log("First Day: ", firstDay);
                console.log("Last Day: ", lastDay);

                // If needed, you can trigger a filter application here
                // $('.apply_filter').trigger('click');
            }

                // Log the selected duration start and end dates
                const durationStarts = $(".report_form_fields input[name='duration_starts']").val();
                const durationEnds = $(".report_form_fields input[name='duration_ends']").val();
                console.log("Selected Duration Start Date: ", durationStarts);
                console.log("Selected Duration End Date: ", durationEnds);
            });

            window.onload = function () {
                var chartData = [];
                @foreach ($groupedLeads as $repName => $groupedLeadsByRep)
                    var totalLeadCount = {{ $groupedLeadsByRep->count() }};
                    chartData.push({
                    label: "{{ $repName }}",
                        y: totalLeadCount,
                    });
                @endforeach
                var options = {
                    animationEnabled: true,
                    title: {
                        text: "Job Won Report"
                    },
                    axisY: {
                        title: "Success Job",
                        // suffix: "%"
                    },
                    axisX: {
                        title: "Customer"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0#",
                        dataPoints: chartData
                    }]
                };
                $("#chartContainer").CanvasJSChart(options);
            }
    </script>
    <script>
        $(document).ready(function () {
            $("#filter-form").validate({
                rules: {
                    duration_starts: {
                        required: true
                    },
                    duration_ends: {
                        required: true,
                        // greaterThan: "#duration_starts"
                    },
                },
                messages: {
                    duration_starts: {
                        required: "Please select the start date"
                    },
                    duration_ends: {
                        required: "Please select the end date",
                        // greaterThan: "Duration end should be greater than Duration start"
                    },
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".mb-3").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
        });
</script>
@endpush

