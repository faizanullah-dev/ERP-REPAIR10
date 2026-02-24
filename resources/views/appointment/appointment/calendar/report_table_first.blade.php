@extends('layouts.master')
@section('content')
    <section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Appointment Report Table</h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                            <ul>
                                <li class="borderRadius {{ request()->is('appointment_report_table') ? 'active' : '' }}"><a href="{{ url('appointment_report_table?year=' . ( $yearEstimation ?? date('Y'))) }}">Appointment Report Table</a></li>
                                <li class="borderRadius {{ request()->is('appointment_report_table_first') ? 'active' : '' }}"><a href="{{ url('appointment_report_table_first?year=' . ( $yearEstimation ?? date('Y'))) }}">Appointment Report Table First</a></li>
                                <li class="borderRadius {{ request()->is('sales_weekly') ? 'active' : '' }}"><a href="{{ url('sales_weekly?year=' . ( $yearEstimation ?? date('Y'))) }}">Sales Weekly</a></li>
                                <li class="borderRadius {{ request()->is('appointment_per_day') ? 'active' : '' }}"><a href="{{ url('appointment_per_day?year=' . ( $yearEstimation ?? date('Y'))) }}">Appointment Per Day</a></li>
                            </ul>
                            <div class="advance_btn ml-auto">
                                <form>
                                    <select class="form-control clr_input_fields borderRadius select2" id="year_filter" name="year">
                                        <option value="" {{ request()->get('year') == '' ? 'selected' : '' }}>Select Year</option>
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
                                    <th>Leads <br> <strong style="color: black; font-size: larger;">{{$leadsCount??'Not Available'}}</strong> </th>
                                    <th>Won Leads <br> <strong style="color: black; font-size: larger;">
                                            {{ $wonLeadsCount ?? 'Not Available' }}
                                        </strong></th>
                                    <th>Lost Leads<br> <strong style="color: black; font-size: larger;">
                                            {{ $lostLeadsCount ?? 'Not Available' }}
                                        </strong></th>
                                    <th>Pending Leads <br> <strong style="color: black; font-size: larger;">
                                            {{ $pendingLeadsCount ?? 'Not Available' }}
                                        </strong></th>
                                    <th>Appointments <br> <strong style="color: black; font-size: larger;">{{$appointmentCount??''}}</strong></th>
                                    <th>Inactive Appointments <br> <strong style="color: black; font-size: larger;">
                                            {{ $appointmentInactiveCount ?? 'Not Available' }}
                                        </strong></th>
                                    <th>Monthly Appointment</th>
                                    <th>Monthly Lead Won</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($weekData as $weekInfo)
                                    <tr>
                                        <td class="align-middle">Week {{ $weekInfo['week'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['dateRange'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['leadCounts']['won'] + $weekInfo['leadCounts']['lost'] +
                                         $weekInfo['leadCounts']['pending']  == 0 ? '-' : ($weekInfo['leadCounts']['won'] +
                                         $weekInfo['leadCounts']['lost'] + $weekInfo['leadCounts']['pending']) }}</td>
                                        <td class="align-middle">{{ $weekInfo['leadCounts']['won'] == 0 ? '-' : $weekInfo['leadCounts']['won'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['leadCounts']['lost'] == 0 ? '-' : $weekInfo['leadCounts']['lost'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['leadCounts']['pending'] == 0 ? '-' : $weekInfo['leadCounts']['pending'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['appointmentsWeeklyCount'] == 0 ? '-' : $weekInfo['appointmentsWeeklyCount'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['inactiveAppointmentsWeeklyCount'] == 0 ? '-' : $weekInfo['inactiveAppointmentsWeeklyCount'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['appointmentsMonthlyCount'] == 0 ? '-' : $weekInfo['appointmentsMonthlyCount'] }}</td>
                                        <td class="align-middle">{{ $weekInfo['leadMonthlyCount'] == 0 ? '-' : $weekInfo['leadMonthlyCount'] }}</td>
                                    </tr>
                                @endforeach
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
    <script>
        $(document).ready(function() {
            $('#year_filter').change(function() {
                var selectedYear = $(this).val();
                var currentYear = selectedYear;
                $('#current_year').text(currentYear);
                $(this).closest('form').submit();
            });
        });
    </script>

@endpush