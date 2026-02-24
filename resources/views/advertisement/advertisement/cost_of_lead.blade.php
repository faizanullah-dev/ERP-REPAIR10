{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--@endpush--}}
{{--@section('content')--}}
{{--    <section class="cost_of_lead">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <h4 class="lead_heading">Estimated Cost On Advertising</h4>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            @php--}}
{{--                                $totalMonthNeededLeads = 0;--}}
{{--                            @endphp--}}
{{--                            @foreach($yearEstimations as $yearEstimation)--}}
{{--                                @php--}}
{{--                                    $currentYears = \App\YearEstimation::where('status', 1)->first()->year;--}}
{{--                                    $currentYear = intval(substr($currentYears, 0, 4));--}}
{{--                                    $totalMonthRequiredLeads = $yearEstimation->months->sum('month_required_leads');--}}
{{--                                    $totalMonthNeededLeads = $yearEstimation->months->sum('month_needed_leads');--}}
{{--                                    $roofSold40 = $totalMonthNeededLeads * ($yearEstimation->extra_push/100);--}}
{{--                                    $totalSales = $yearEstimation->amount_per_job * $totalMonthRequiredLeads;--}}
{{--                                    $totalSales40 = $roofSold40 * $yearEstimation->amount_per_job;--}}
{{--                                    $leadWonCount = $lead->where('lead_status', 'won')->where('lead_date', $currentYear)->count();--}}
{{--                                    $appointmentCount = $appointment->filter(fn($appointment) => $appointment->created_at->format('Y') == $currentYear)->where('status', 1)->count();--}}

{{--                                    if ($appointmentCount != 0) {--}}
{{--                                        $actualAppointmentClosingRate = ($leadWonCount / $appointmentCount) * 100;--}}
{{--                                    } else {--}}
{{--                                        $actualAppointmentClosingRate = 0;--}}
{{--                                    }--}}
{{--                                    $advertisementYearlyBudget = $advertisement->where('year', $currentYear)->sum('monthly_budget');--}}
{{--                                    if($appointmentCount != 0) {--}}
{{--                                    $costPerAppointment = $advertisementYearlyBudget / $appointmentCount;--}}
{{--                                    } else {--}}
{{--                                    $costPerAppointment = 0;--}}
{{--                                    }--}}
{{--                                    if($leadWonCount != 0) {--}}
{{--                                    $costPerJob = $advertisementYearlyBudget / $leadWonCount;--}}
{{--                                    } else {--}}
{{--                                    $costPerJob = 0;--}}
{{--                                    }--}}
{{--                                    if($leadWonCount != 0) {--}}
{{--                                        $averageJobPrice = $lead->where('lead_date', $currentYear)->where('lead_status', 'won')->sum('lead_price') / $leadWonCount;--}}
{{--                                    } else {--}}
{{--                                        $averageJobPrice = 0;--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                <tr>--}}
{{--                                    <th> Closing Rate </th>--}}
{{--                                    <th> {{ $yearEstimation->job_convertion_ratio??"" }}%</th>--}}
{{--                                    <th> {{ $yearEstimation->extra_push??"" }}% </th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td id="target_lead_id"> </td>--}}
{{--                                    <td> </td>--}}
{{--                                    <td class="gross_income" >  </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th> Cost Of Appointment </th>--}}
{{--                                    <th>Cost Per Job </th>--}}
{{--                                    <th> Cost Per Job </th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="cost_of_appointment"> </td>--}}
{{--                                    <td class="cost_job_30"> </td>--}}
{{--                                    <td class="cost_job_40">  </td>--}}
{{--                                <tr>--}}
{{--                                    <th> Closing Rate </th>--}}
{{--                                    <th>Roofs Sold </th>--}}
{{--                                    <th> Roofs Sold </th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $yearEstimation->job_convertion_ratio??"" }}%</td>--}}
{{--                                    <td>{{ $totalMonthRequiredLeads }}</td>--}}
{{--                                    <td>{{ $roofSold40 ??'0' }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>Average Roof Price</th>--}}
{{--                                    <th> </th>--}}
{{--                                    <th> </th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>${{ $yearEstimation->amount_per_job }}</td>--}}
{{--                                    <td>  </td>--}}
{{--                                    <td>  </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>Total Appointment</th>--}}
{{--                                    <th> Total Sales</th>--}}
{{--                                    <th> </th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $totalMonthNeededLeads }}</td>--}}
{{--                                    <td>${{ $totalSales }}</td>--}}
{{--                                    <td>${{ $totalSales40 }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>Advertising Budget</th>--}}
{{--                                    <th class="advertise_budget"></th>--}}
{{--                                    <th></th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td> </td>--}}
{{--                                    <td>  </td>--}}
{{--                                    <td></td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <h4 class="lead_heading">Actual Cost On Appointment/ Job </h4>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th> Closing Rate  </th>--}}
{{--                                <th>{{ round($actualAppointmentClosingRate ?? 0, 2) }}%</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Cost Per Appointment</th>--}}
{{--                                <th>Cost Per Job</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>${{ round($costPerAppointment ?? 0, 2) }}</td>--}}
{{--                                <td>${{ round($costPerJob?? 0, 2) }}</td>--}}
{{--                                <td>  </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Total Appointment</th>--}}
{{--                                <th>Roofs Sold</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>{{ $appointmentCount ?? '0' }}</td>--}}
{{--                                <td>{{ $leadWonCount ?? '0' }}</td>--}}
{{--                                <td></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Advertising Cost</th>--}}
{{--                                <th>${{ $advertisementYearlyBudget ?? '0' }}</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>Average Job Price</td>--}}
{{--                                <td>${{ round($averageJobPrice ?? 0,2) }}</td>--}}
{{--                                <td></td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <h4 class="lead_heading">Cost On Running The Appointment </h4>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th> Cost Of Stop Per Appointment  </th>--}}
{{--                                <th class="cost_of__stop_appointment"></th>--}}
{{--                                <th>  </th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>  </td>--}}
{{--                                <td>  </td>--}}
{{--                                <td>  </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Cost Per Mile</th>--}}
{{--                                <th></th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td> $1.37  </td>--}}
{{--                                <td> Loan,Gas Maintanance </td>--}}
{{--                                <td>  </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Average Mille Per Appointment</th>--}}
{{--                                <th></th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>85</td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Appointment Cost</th>--}}
{{--                                <th class="appointment_cost"></th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            --}}{{--                    <tr>--}}
{{--                            --}}{{--                        <td>Average Job Price</td>--}}
{{--                            --}}{{--                        <td>$16167.43</td>--}}
{{--                            --}}{{--                        <td></td>--}}
{{--                            --}}{{--                    </tr>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endsection--}}
{{--@push('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            var estimateAmount          = {{ $yearEstimation->estimate_amount??0 }};--}}
{{--            var grossIncome             = estimateAmount * 0.04;--}}
{{--            $('.advertise_budget').text('$' + grossIncome);--}}
{{--            var costPerJobBy30          = grossIncome / {{ $totalMonthRequiredLeads ?? 0 }};--}}
{{--            $('.cost_job_30').text('$' + costPerJobBy30.toFixed(2));--}}
{{--            var costPerJobBy40          = grossIncome /  {{ $roofSold40 ?? 0 }} ;--}}
{{--            $('.cost_job_40').text('$' + costPerJobBy40.toFixed(2));--}}
{{--            var costOfAppointment       = grossIncome/{{ $totalMonthNeededLeads ?? 0 }};--}}
{{--            $('.cost_of_appointment').text('$' + costOfAppointment.toFixed(2));--}}
{{--            var costOfStopPerAppointment = 85 * 1.37;--}}
{{--            $('.cost_of__stop_appointment').text('$' + costOfStopPerAppointment.toFixed(2));--}}
{{--            var AppoointmentCost = {{ $totalMonthNeededLeads ?? 0 }} * costOfStopPerAppointment ?? 0 ;--}}
{{--            $('.appointment_cost').text('$' + AppoointmentCost.toFixed(2));--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}







@extends('layouts.master')

@section('content')
    <section class="cost_of_lead white-box">
        <div class="container-fluid">
            <div class="row">
                <div class="card-headerr mb-4">
                    <h5>Yearly Advertising Budget {{ $selectedYear??"" }}</h5>
                </div>
                <div class="col-md-12">
                <div class="advance_btn ml-auto">
                    <form>
                        {{--                                <label for="Select Category" class="form-label input_labels p-18">Select Year</label>--}}
                        <select class="form-control clr_input_fields borderRadius select2 w-25" id="year_filter" name="year">
                            <option value="" {{ request()->get('year') == '' ? 'selected' : '' }}>Select Year</option>
                            @foreach($years as $year)
                                <option value="{{$year->year}}" {{ request()->get('year') == $year->year ? 'selected' : '' }}>{{$year->year}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                </div>
                <div class="col-md-6">
                    <h4 class="lead_heading">Estimated Cost On Advertising</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            @php
                                $totalMonthNeededLeads = 0;
                            @endphp
                            @foreach($yearEstimations as $yearEstimation)
                                @php
                                    $totalMonthRequiredLeads = $yearEstimation->months->sum('month_required_leads');
                                    $totalMonthNeededLeads = $yearEstimation->months->sum('month_needed_leads');
                                    $roofSold40 = $totalMonthNeededLeads * ($yearEstimation->extra_push/100);
                                    $totalSales = $yearEstimation->amount_per_job * $totalMonthRequiredLeads;
                                    $totalSales40 = $roofSold40 * $yearEstimation->amount_per_job;
                                @endphp
                                <tr>
                                    <th> Closing Rate </th>
                                    <th> {{ $yearEstimation->job_convertion_ratio??"" }}%</th>
                                    <th> {{ $yearEstimation->extra_push??"" }}% </th>
                                </tr>
                                <tr>
                                    <td id="target_lead_id"> </td>
                                    <td> </td>
                                    <td class="gross_income" >  </td>
                                </tr>
                                <tr>
                                    <th> Cost Of Appointment </th>
                                    <th>Cost Per Job </th>
                                    <th> Cost Per Job </th>
                                </tr>
                                <tr>
                                    <td class="cost_of_appointment"> </td>
                                    <td class="cost_job_30"> </td>
                                    <td class="cost_job_40">  </td>
                                </tr>
                                <tr>
                                    <th> Closing Rate </th>
                                    <th>Roofs Sold </th>
                                    <th> Roofs Sold </th>
                                </tr>
                                <tr>
                                    <td>{{ $yearEstimation->job_convertion_ratio??"" }}%</td>
                                    <td>{{ $totalMonthRequiredLeads }}</td>
                                    <td>{{ $roofSold40 ??'0' }}</td>
                                </tr>
                                <tr>
                                    <th>Average Roof Price</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <td>${{ $yearEstimation->amount_per_job }}</td>
                                    <td>  </td>
                                    <td>  </td>
                                </tr>
                                <tr>
                                    <th>Total Appointment</th>
                                    <th> Total Sales</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <td>{{ $totalMonthNeededLeads }}</td>
                                    <td>${{ $totalSales }}</td>
                                    <td>${{ $totalSales40 }}</td>
                                </tr>
                                <tr>
                                    <th>Advertising Budget</th>
                                    <th class="advertise_budget"></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>  </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="lead_heading">Actual Cost On Appointment/ Job </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th> Closing Rate  </th>
                                <th>{{ round($actualAppointmentClosingRate ?? 0, 2) }}%</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Cost Per Appointment</th>
                                <th>Cost Per Job</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>${{ round($costPerAppointment ?? 0, 2) }}</td>
                                <td>${{ round($costPerJob?? 0, 2) }}</td>
                                <td>  </td>
                            </tr>
                            <tr>
                                <th>Total Appointment</th>
                                <th>Roofs Sold</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>{{ $appointmentCount ?? '0' }}</td>
                                <td>{{ $leadWonCount ?? '0' }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Advertising Cost</th>
                                <th>${{ $advertisementYearlyBudget ?? '0' }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Average Job Price</td>
                                <td>${{ round($averageJobPrice ?? 0,2) }}</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="lead_heading">Cost On Running The Appointment </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th> Cost Of Stop Per Appointment  </th>
                                <th class="cost_of__stop_appointment"></th>
                                <th>  </th>
                            </tr>
                            <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                            </tr>
                            <tr>
                                <th>Cost Per Mile</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="cost_per_mile_one" id="cost_per_mile_one">
                                </td>
                                <td>Loan, Gas Maintenance</td>
                                <td>  </td>
                            </tr>
                            <tr>
                                <th>Average Mile Per Appointment</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="average_per_mile_one" id="average_per_mile_one">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Appointment Cost</th>
                                <th class="appointment_cost"></th>
                                <th></th>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var defaultCostPerMileOne = 1.37;
            var defaultAveragePerMileOne = 85;
            $('#cost_per_mile_one').val(defaultCostPerMileOne);
            $('#average_per_mile_one').val(defaultAveragePerMileOne);

            $('#average_per_mile_one, #cost_per_mile_one').on('input', calculateAndInsert);

            $('#year_filter').change(function() {
                var selectedYear = $(this).val();
                var currentYear = selectedYear;
                $('#current_year').text(currentYear);
                console.log("Selected year: " + currentYear);
                $(this).closest('form').submit();
            });

            var estimateAmount = {{ $yearEstimations->first()->estimate_amount ?? 0 }};
            var grossIncome = estimateAmount * 0.04;
            $('.advertise_budget').text('$' + grossIncome.toFixed(2));

            var costPerJobBy30 = grossIncome / {{ $totalMonthRequiredLeads ?? 0 }};
            $('.cost_job_30').text('$' + costPerJobBy30.toFixed(2));

            var costPerJobBy40 = grossIncome / {{ $roofSold40 ?? 0 }};
            $('.cost_job_40').text('$' + costPerJobBy40.toFixed(2));

            var costOfAppointment = grossIncome / {{ $totalMonthNeededLeads ?? 0 }};
            $('.cost_of_appointment').text('$' + costOfAppointment.toFixed(2));

            function calculateAndInsert() {
                var defaultCostPerMileOne = 1.37;
                var defaultAveragePerMileOne = 85;

                var average_per_mile_one = parseFloat($('#average_per_mile_one').val()) || defaultAveragePerMileOne;
                var cost_per_mile_one = parseFloat($('#cost_per_mile_one').val()) || defaultCostPerMileOne;

                var cost_of_stop_appointment = average_per_mile_one * cost_per_mile_one;
                $('.cost_of__stop_appointment').text('$' + cost_of_stop_appointment.toFixed(2));

                var costOfStopPerAppointment = average_per_mile_one * cost_per_mile_one;
                $('.cost_of__stop_appointment').text('$' + costOfStopPerAppointment.toFixed(2));

                var appointmentCost = {{ $totalMonthNeededLeads ?? 0 }} * costOfStopPerAppointment;
                $('.appointment_cost').text('$' + appointmentCost.toFixed(2));
            }

            calculateAndInsert();
        });

    </script>
@endpush