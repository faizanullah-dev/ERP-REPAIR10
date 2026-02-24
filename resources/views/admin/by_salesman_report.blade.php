@extends('layouts.master')
@section('content')
    <section class="performance_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Sales Performance Report</h5>
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

                        <div class="row" >
                            <div class="col-md-6 col-sm-5">
                                <div class="white-box">
                                    <a href="{{ route('job_listings')}}" class="fs-1">
                                    <h3>Total Jobs</h3>
                                    {{ $totalLeadCount ??'0' }}
                                    <hr>
{{--                                    <span class="fs-5">Proposal Sent: 220</span>--}}
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-5">
                                <div class="white-box">
                                    <h3>Appointment(#)</h3>
                                    <a href="" class="fs-1">
                                        {{ $appointment->count() ??"0" }}
                                    </a>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-5">
                                <div class="white-box">
                                    <h3>Jobs Won(#)</h3>
                                    <a href="{{ route('job_listings') }}" class="fs-1">
                                        {{ $leads->where('lead_status','won')->count() ??'0' }}
                                    </a>
                                    <hr>
                                    <span class="fs-5">Jobs Won In Duration: <strong>{{ $leads->where('lead_status','won')->count() ??"00" }}</strong></span>
                                    <span class="fs-5">Close Ratio In Duration: <strong>{{ $closeRatio ??"0" }}</strong></span>
                                    <span class="fs-5">Closing %</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="white-box">
                                    <h3>lost Job(#)</h3>
                                    <a href="{{ route('job_listings') }}" class="fs-1">{{ $lostLead ??"00"  }}</a>
                                    <hr>
                                    <span class="fs-5">Lost Job In Duration: <strong>{{ $lostLead ??'0'  }}</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-5">
    <div class="white-box">
        <h3>Amount($)</h3>
        @php
            $wonLeadsSum = $leads->where('lead_status','won')->sum(function($lead) {
                return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
            });
            $approvedChangeOrdersSum = $changeOrder->where('status','approved')->sum(function($order) {
                return is_numeric($order->total_amount) ? (float)$order->total_amount : 0;
            });
        @endphp
        <p class="fs-1">${{ number_format($wonLeadsSum + $approvedChangeOrdersSum, 2) }}</p>
        <hr>
        <span class="fs-5">Job Amount: <strong>${{ number_format($wonLeadsSum, 2) }}</strong></span>
        <span class="fs-5 mx-3">Change Order Amount: <strong>${{ number_format($approvedChangeOrdersSum, 2) }}
</strong></span>
    </div>
</div>
                            <div class="col-md-6 col-sm-5">
                                <div class="white-box">
                                    <h3>Net Sales Per Lead Issued</h3>
{{--                                    <p class="fs-1">${{ number_format(floatval($netSale)) }}</p>--}}
                                    <p class="fs-1">${{ number_format(floatval($netSalesPerLead), 2) }}</p>
                                    <hr>
{{--                                    <span class="fs-5 mx-3">Net Sale: <strong>${{ number_format($netSale)??'' }}</strong></span>--}}
{{--                                    <span class="fs-5">Sales Commission: <strong>${{ number_format($salesCommission)??'' }}</strong></span>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-5">
                                <div class="white-box">
                                    <h3>Value Per Lead Sold($)</h3>
                                    <p class="fs-1">${{ number_format($valuePerLead ?? 0, 2) }}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-body bg-white">
                            <div class="report_form_fields">
                                <form id="filter-form" action="{{ route('by_salesman') }}" method="get">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="user" class="form-label input_labels p-18">User</label>
                                            <select class="form-control  select2 borderRadius" name="representative_id" id="representative_id">
                                                <option value="">--Select Customer--</option>
                                                @foreach($staffs as $key => $staff)
                                                    <option value="{{$staff->id}}" {{ request()->get('representative_id') == $staff->id ? 'selected' : '' }}>{{$staff->name??"not available"}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Customer_Type" class="form-label input_labels p-18">Customer Type</label>
                                            <select class="form-control  select2 borderRadius" name="customerType_id" id="customerType_id">
                                                <option value="">--Select CustomerType --</option>
                                                @foreach ($customerTypes as $customerType)
                                                    <option value="{{$customerType->id}}" {{request()->get('customerType_id')== $customerType->id ? 'selected' : '' }}>{{$customerType->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                                    <div class="mb-3">
                                        <label for="select-duration" class="form-label input_labels p-18">Select Duration Starts</label>
                                        <input name="duration_starts" type="date" placeholder="duration_start"
                                               class="form-control clr_input_fields borderRadius" value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" id="select-duration" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="select-duration" class="form-label input_labels p-18">Select Duration Ends</label>
                                        <input name="duration_ends" type="date" placeholder="duration_start"
                                               class="form-control clr_input_fields borderRadius" value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}" id="select-duration" >
                                    </div>

                                    <div class="mb-3">
                                    <label for="address" class="form-label input_labels p-18">Division</label>
                                    <select class="form-control  select2 borderRadius" name="category_id" id="category_id">
                                        <option value="">--Select Division--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                                    <div class="reset_apply_btn">
                                        <a href="{{url('by_salesman')}}" class="btn border_btns borderRadius gray_btn">Reset</a>
                                        <button type="submit" class="btn border_btns borderRadius blue_btn" id="apply-button" onclick="this.disabled = true; this.form.submit();" >Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     $("#filter-form").validate({
        //         rules: {
        //             duration_starts: {
        //                 required: true
        //             },
        //             duration_ends: {
        //                 required: true
        //             },
        //         },
        //         messages: {
        //             duration_starts: {
        //                 required: "Please select the start date"
        //             },
        //             duration_ends: {
        //                 required: "Please select the end date"
        //             },
        //         },
        //         errorElement: "span",
        //         errorPlacement: function (error, element) {
        //             error.addClass("invalid-feedback");
        //             element.closest(".mb-3").append(error);
        //         },
        //         highlight: function (element, errorClass, validClass) {
        //             $(element).addClass("is-invalid").removeClass("is-valid");
        //         },
        //         unhighlight: function (element, errorClass, validClass) {
        //             $(element).removeClass("is-invalid").addClass("is-valid");
        //         }
        //     });
        // });
    </script>
@endpush
