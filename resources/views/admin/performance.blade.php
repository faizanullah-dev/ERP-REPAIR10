@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
@endpush

@section('content')
    <section class="performance_section mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Customers Sales Performance Report</h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                            <ul>
                                <li class="borderRadius {{ request()->is('jobs_won') ? 'active' : '' }}"><a href="{{ url('jobs_won') }}">Jobs Won</a></li>
                                <li class="borderRadius {{ request()->is('performance') ? 'active' : '' }}"><a href="{{ url('performance') }}">Performance(#)</a></li>
                                <li class="borderRadius {{ request()->is('by_salesman') ? 'active' : '' }}"><a href="{{ url('by_salesman') }}">By Salesman</a></li>
                                <li class="borderRadius {{ request()->is('summary') ? 'active' : '' }}"><a href="{{ url('summary') }}">Summary</a></li>
                                <li class="borderRadius {{ request()->is('job_listings') ? 'active' : '' }}"><a href="{{ url('job_listings') }}">Job Listing(#)</a></li>
                            </ul>
                        </div>
                        <div class="white-box">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-body bg-white">
                            <div class="report_form_fields">
                                <form id="filter-form" method="get" action="{{url('performance')}}">
                                    <div class="report_form_fields">
                                        <div class="mb-3">
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
                                            {{--  Note: both duration_starts and duration_ends have same id --}}
                                            <label for="select-duration" class="form-label input_labels p-18">Select Duration Starts</label>
                                            <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_starts"  value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" id="duration">
                                        </div>
                                        <div class="mb-3">
                                            <label for="select-duration" class="form-label input_labels p-18">Select Duration Ends</label>
                                            <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_ends"  value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}" id="duration">
                                        </div>
                                        <div class="mb-3">
                                            <label for="user" class="form-label input_labels p-18">Division</label>
                                            <select class="form-control select2 borderRadius" name="category_id" id="category_id"  >
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
                                                <option value="">--Select User--</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}" {{ request()->get('customer_id') == $customer->id ? 'selected' : '' }}>{{$customer->name??''}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="reset_apply_btn">
                                            <a href="{{url('performance')}}" class="btn border_btns borderRadius gray_btn">Reset</a>
                                            <button type="submit" class="btn border_btns borderRadius blue_btn" onclick="this.disabled = true; this.form.submit();">Apply</button>
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
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
    <script>
        window.onload = function () {
            var options = {
                animationEnabled: true,
                title: {
                    text: "CUSTOMER SALES PERFORMANCE"
                },
                axisY: {
                    title: "SUCCESSFUL SALES",
                    valueFormatString: "$#,##0.0",
                },
                axisX: {
                    title: "CUSTOMERS"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "$#,##0.0",
                    dataPoints: [
                            @foreach ($groupedLeads as $repName => $groupedLeadsByRep)
                            @php
                                $totalLeadCount = $groupedLeadsByRep->count();
                                $totalLeadPrice = $groupedLeadsByRep->sum(function($lead) {
                                    return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
                                });
                                $totalChangeOrders = $groupedLeadsByRep->sum(function($lead) {
                                    return $lead->getChangeOrder->count();
        });
                                $totalChangeOrderAmount = $groupedLeadsByRep->sum(function($lead) {
                                    return $lead->getChangeOrder()->where('status','approved')->sum('total_amount');
        });
//                                $totalSalesAmount = $totalLeadPrice;
                                $latestLead = $groupedLeadsByRep->sortByDesc('created_at')->first();
                            @endphp
                        { label: "{{ $repName }}", y: {{ $totalLeadPrice + $totalChangeOrderAmount }} },
                        @endforeach
                    ]
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
                        required: true
                    },
                    // category_id: {
                    //     required: true
                    // },
                    // customer_id: {
                    //     required: true
                    // },
                    // customerType_id: {
                    //     required: true
                    // }
                },
                messages: {
                    duration_starts: {
                        required: "Please select the start date"
                    },
                    duration_ends: {
                        required: "Please select the end date"
                    },
                    // category_id: {
                    //     required: "Please select a category"
                    // },
                    // customer_id: {
                    //     required: "Please select a user"
                    // },
                    // customerType_id: {
                    //     required: "Please select a customer type"
                    // }
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
