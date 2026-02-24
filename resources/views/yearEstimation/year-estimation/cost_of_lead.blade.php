@extends('layouts.master')
@push('css')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h4>Estimated Cost On Advertising</h4>
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
                            $leadWonCount = $lead->where('lead_status', 'won')->count();
                            $appointmentCount = $appointment->where('status', 1)->count();
                            if ($appointmentCount != 0) {
                            $actualAppointmentClosingRate = ($leadWonCount / $appointmentCount) * 100;
                            } else {
                            $actualAppointmentClosingRate = 0;
                            }
                            $advertisementYearlyBudget = $advertisement->where('year', $currentYear)->sum('monthly_budget');
                            if($appointmentCount != 0) {
                            $costPerAppointment = $advertisementYearlyBudget / $appointmentCount;
                            } else {
                            $costPerAppointment = 0;
                            }
                            if($leadWonCount != 0) {
                            $costPerJob = $advertisementYearlyBudget / $leadWonCount;
                            } else {
                            $costPerJob = 0;
                            }
                            if($leadWonCount != 0) {
                            $averageJobPrice = $lead->where('lead_status', 'won')->sum('lead_price') / $leadWonCount;
                            } else {
                            $averageJobPrice = 0;
                            }
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
                        <tr>

                            <th> Closing Rate </th>
                            <th>Roofs Sold </th>
                            <th> Roofs Sold </th>
                        </tr>
                        <tr>
                            <td>{{ $yearEstimation->job_convertion_ratio??"" }}%</td>
                            <td>{{ $totalMonthRequiredLeads }}</td>
                            <td>{{ $roofSold40 }}</td>
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
            <div class="col-md-6">
                <h4>Actual Cost On Appointment/ Job </h4>
                <table class="table table-bordered">
                    <tr>
                        <th> Closing Rate  </th>
                        <th>{{ round($actualAppointmentClosingRate, 2) }}%</th>
                        <th>  </th>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <th>Cost Per Appointment</th>
                        <th>Cost Per Job</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>${{ round($costPerAppointment, 2) ?? 0 }}</td>
                        <td>${{ round($costPerJob, 2) }}</td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <th>Total Appointment</th>
                        <th>Roofs Sold</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>{{ $appointmentCount }}</td>
                        <td>{{ $leadWonCount }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Advertising Cost</th>
                        <th>${{ $advertisementYearlyBudget }}</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Average Job Price</td>
                        <td>${{ $averageJobPrice }}</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h4>Cost On Running The Appointment </h4>
                <table class="table table-bordered">
                    <tr>
                        <th> Cost Of Stop Per Appointment  </th>
                        <th> $116.45 </th>
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
                        <td> $1.37 Loan,Gas Maintanance </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <th>Average Mille Per Appointment</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>85</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Appointment Cost</th>
                        <th>$133181.32</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Average Job Price</td>
                        <td>$16167.43</td>
                        <td></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var estimateAmount = {{ $yearEstimation->estimate_amount??0 }};
            var grossIncome = estimateAmount * 0.04;
            $('.advertise_budget').text('$' + grossIncome);
            var costPerJobBy30 = grossIncome / {{ $totalMonthRequiredLeads }};
            $('.cost_job_30').text('$' + costPerJobBy30.toFixed(2));
            var costPerJobBy40 = grossIncome /  costPerJobBy30 ;
            $('.cost_job_40').text('$' + costPerJobBy40);
            var costOfAppointment = grossIncome/{{ $totalMonthNeededLeads }};
            $('.cost_of_appointment').text('$' + costOfAppointment.toFixed(2));
        });
    </script>
@endpush