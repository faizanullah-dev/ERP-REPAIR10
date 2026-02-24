@extends('layouts.master')
@section('content')
<section class="job_listings_section pt-3">
        <div class="container-fluid">
            <div class="row white-box">
                <div class="col-md-12">
                    <div class="card">
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
                            <div class="advance_btn ml-auto">
                                <input class="form-control  borderRadius search_bar" id="search_bar" type="text" placeholder="Advance Search">
                            </div>
                        </div>
                        <form id="filter-form" method="get" action="{{url('job_listings')}}">
                        <div class="form_div mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="customer-name" class="form-label input_labels p-18">Users</label>
                                        <select class="form-control select2 borderRadius" name="customer_id" id="customer_id" data-placeholder="--Select User--">
                                            @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}" {{ request()->get('customer_id') == $customer->id ? 'selected' : '' }}>{{$customer->name??''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="customer-name" class="form-label input_labels p-18">Select Division</label>
                                        <select class="form-control select2 borderRadius category_id" data-placeholder="--Select Division--" name="category_id" id="" >
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name??''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="customer-name" class="form-label input_labels p-18">Customer Type</label>
                                        <select class="form-control select2 borderRadius category_id" data-placeholder="--Select CustomerType--" name="customerType_id" id="" >
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
                                <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="select-duration" class="form-label input_labels p-18">Select Duration Starts</label>
                                        <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_starts" value="{{request()->get('duration_starts')?? $yearEstimation->year . '-01-01'}}" id="duration_starts" required>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                        <div class="form-group">
                                    <label for="select-duration" class="form-label input_labels p-18">Select Duration Ends</label>
                                    <input type="date" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="duration_ends" value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}" id="duration_ends" required>
                                </div>

                                </div>
                                <div class="col-md-4" >

                                        {{--                                <div class="reset_apply_btn form-group">--}}

                                        {{--                                                    <a href="{{url('job_listings')}}" class="btn border_btns borderRadius">Reset</a>--}}
                                        {{--                                                    <button type="submit" class="btn border_btns borderRadius" onclick="this.disabled = true; this.form.submit();">Apply</button>--}}
                                        {{--                                                --}}
                                        {{--                                </div>--}}
                                        <div class="filter_inputs_parent filter_btns_parent">
                                            <label for="" class="form-label input_labels p-18"></label>
                                            <div class="reset_apply_btn">
                                                <button type="submit" class="btn blue_btn "  onclick="this.disabled = true; this.form.submit();">Apply <i class="fa-solid fa-check"></i></button>
                                                <a href="{{ url('job_listingsr') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                                            </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        </form>
                        <div class="table_div mt-5">
                        <table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">Customer Information</th>
									<th scope="col">Description</th>
                                    <th scope="col">Types</th>
									</tr>
								</thead>
								<tbody>
                                    @forelse($leads as $key => $lead)
                                        <tr>
                                            <th class="align-middle" scope="row">
                                                <p>{{$lead->title??''}} // {{$lead->customer->name??''}} // {{$lead->lead_number??''}}</p>
                                                <p>{{$lead->customer->email??''}}</p>
                                                @if($lead->customer && $lead->customer->customerPhones->count() > 0)
                                                    @foreach($lead->customer->customerPhones as $customer)
                                                        <p>{{$customer->phone ?? ''}},</p>
                                                    @endforeach
                                                @endif
                                            </th>
                                            <td class="align-middle">
                                                <p>{!! $lead->description ? substr($lead->description, 0, 100) . '....' : '' !!}</p>
                                                <p>Customer Rep:  {{$lead->customer->name??''}} </p>
                                                <p>Job Rep / Estimator: {{$lead->representative->name??''}} </p>
                                                <p>Project Cost: ${{ sprintf('%.2f', (float) ($lead->lead_price ?? 0)) }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p>Category Type: {{$lead->category->name??''}}</p>
                                                    <p>Last Modified {{ $lead->updated_at->diffForHumans() }}</p>
                                                    <p>Moved To Lead <b>{!! $lead->getStage->name ?? "No Stage Found" !!}</p>
                                                <p>Creation Date: {{ \Carbon\Carbon::parse($lead->lead_date ?? '')->format('m-d-Y') }}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">  <b>No Record Found</b></td>
                                        </tr>
                                    @endforelse

                                </tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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


        $(document).ready(function () {
            $("#filter-form").validate({
                rules: {
                    duration_starts: {
                        required: true
                    },
                    duration_ends: {
                        required: true
                    },
                },
                messages: {
                    duration_starts: {
                        required: "Please select the start date"
                    },
                    duration_ends: {
                        required: "Please select the end date"
                    },
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
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
