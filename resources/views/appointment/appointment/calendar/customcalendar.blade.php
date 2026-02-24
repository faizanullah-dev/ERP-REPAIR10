@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <style>
        .blue-bg {
            background-color: #d9e1f2; /* Grey color for weekdays */
        }
        .pink-bg {
            background-color: #fce4d6; /* Yellow color for weekends */
        }
    </style>
@endpush
@section('content')
    <section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-headerr bg-white">
                        <h5>Daily Appointment </h5>
                    </div>
                    <div class="hr-line mt-2"></div>
                    <div class="report_tabs">
                        <ul>
                            <li class="borderRadius {{ request()->is('appointment_report_table') ? 'active' : '' }}"><a href="{{ url('appointment_report_table?year=' . ( $yearEstimation->year ?? date('Y'))) }}">Appointment Report Table</a></li>
                            <li class="borderRadius {{ request()->is('appointment_report_table_first') ? 'active' : '' }}"><a href="{{ url('appointment_report_table_first?year=' . ( $yearEstimation->year ?? date('Y'))) }}">Appointment Report Table First</a></li>
                            <li class="borderRadius {{ request()->is('sales_weekly') ? 'active' : '' }}"><a href="{{ url('sales_weekly?year=' . ( $yearEstimation->year ?? date('Y'))) }}">Sales Weekly</a></li>
                            <li class="borderRadius {{ request()->is('appointment_per_day') ? 'active' : '' }}"><a href="{{ url('appointment_per_day?year=' . ( $yearEstimation->year ?? date('Y'))) }}">Appointment Per Day</a></li>
                        </ul>
                        <div class="advance_btn ml-auto">
                            <form>
{{--                                <select class="form-control clr_input_fields borderRadius select2" id="year_filter" name="year">--}}
{{--                                    <option value="" {{ request()->get('year') == '' ? 'selected' : '' }}>Select Year</option>--}}
{{--                                    @foreach($years as $year)--}}
{{--                                        <option value="{{$year->year}}" {{ request()->get('year') == $year->year ? 'selected' : '' }}>{{$year->year}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                <select class="form-control clr_input_fields borderRadius select2" id="year_filter" name="year">
                                    <option value="" {{ request()->get('year') == '' ? 'selected' : '' }}>Select Year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->year }}"
                                                {{ request()->get('year') == $year->year || (!request()->has('year') && isset($yearEstimation) && $yearEstimation->year == $year->year) ? 'selected' : '' }}>
                                            {{ $year->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <button class="btn green_btn" onclick="exportTableToCSV('table_data.csv')">Export to CSV</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @php
                            $holidayDates = [];
                            foreach ($holidays as $holiday) {
                                foreach ($holiday->getHoliday as $holidayDate) {
                                    $holidayDates[$holidayDate->date] = true;
                                }
                            }
                        @endphp
                        <table id="myTable" class="display nowrap border" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Months</th>
                                @for ($day = -1; $day < 37; $day++)
                                    @php
                                        $formattedDay = \Carbon\Carbon::now()->startOfWeek()->addDays($day)->format('D');
                                        $class = ($formattedDay == 'Sat' || $formattedDay == 'Sun') ? 'pink-bg' : 'blue-bg';
                                    @endphp
                                    <th scope="col">{{ $formattedDay }}</th>
                                @endfor
                                <th scope="col">Total No of Appointment</th>
                                <th scope="col">Working Days</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $totalWorkingDays = 0;
                                $totalNotWorkingDays = 0;
                            @endphp
                            @for ($month = 1; $month <= 12; $month++)
                                @php
                                    $selectedYear = intval(request()->input('year', date('Y')));
                                    $selectedYear = empty($selectedYear) ? intval(date('Y')) : $selectedYear;
                                    $currentMonth = \Carbon\Carbon::create($selectedYear, $month, 1);
                                    $daysInMonth = $currentMonth->daysInMonth;
                                    $totalAppointments = 0;
                                    $workingDaysCount = 0;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $currentMonth->format('F') }}</th>
                                    @for ($i = 0; $i < 38; $i++)
                                        @if ($i < $currentMonth->startOfMonth()->dayOfWeek || $i >= $currentMonth->startOfMonth()->dayOfWeek + $daysInMonth)
                                            <td></td>
                                        @else
                                            @php
                                                $day = $i - $currentMonth->startOfMonth()->dayOfWeek + 1;
                                                $dateKey = $currentMonth->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                $appointmentCount = $appointmentCounts->get($dateKey) ?? 0;
                                                 $totalAppointments += $appointmentCount;
                                                  $totalNotWorkingDays = 365-$totalWorkingDays ;
                                                // Check if it's a holiday date
                                                $isHoliday = isset($holidayDates[$dateKey]);
                                            @endphp
                                            <td class="{{ $isHoliday ? 'pink-bg' : ($i % 7 == 6 || $i % 7 == 0 ? 'pink-bg' : 'blue-bg') }}">
                                                {{ $day }}
                                            </td>
                                            @if ($isHoliday)
                                                @php $totalNotWorkingDays++; @endphp
                                            @elseif ($i % 7 != 5 && $i % 7 != 6)
                                                @php $workingDaysCount++; $totalWorkingDays++; @endphp
                                            @endif
                                        @endif
                                    @endfor
                                    <td></td>
                                    <td>{{ $workingDaysCount }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold appointment_month_count">{{ $yearEstimation->months[$month-1]->month_required_leads }}</td>
                                    @php
                                        $monthRequiredLeadsDivisor = $workingDaysCount > 0 ? $workingDaysCount : 1;
                                        $monthRequiredLeadsDividedBy20 = $yearEstimation->months[$month-1]->month_required_leads / $monthRequiredLeadsDivisor;
                                    @endphp
                                    @for ($i = 0; $i < 37; $i++)
                                        @if ($i < $currentMonth->startOfMonth()->dayOfWeek || $i >= $currentMonth->startOfMonth()->dayOfWeek + $daysInMonth)
                                            <td></td>
                                        @else
                                            @php
                                                $day = $i - $currentMonth->startOfMonth()->dayOfWeek + 1;
                                                $dateKey = $currentMonth->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                $appointmentCount = $appointmentCounts->get($dateKey) ?? 0;
                                            @endphp
                                            <td class="custom_td_ui">
                                                <div class="custom_td_box">
                                                    <div class="custom_td_left">
                                                        <span>{{ $appointmentCount }}</span>
                                                    </div>
                                                    <div class="custom_td_right">
                                                        <strong>{{ round($monthRequiredLeadsDividedBy20, 2) }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    @endfor
                                    <td></td>
                                    <td>{{ $totalAppointments }}</td>
                                </tr>
                            @endfor
                            <tr class="fw-bold">
                                <td class="fw-bold">Total Appointments</td>
                                @for ($i = 0; $i < 37; $i++)
                                    <td></td>
                                @endfor
                                <td></td>
                                <td>{{ $appointmentCounts->sum() }}</td>
                                <td>{{ $totalWorkingDays ?? 0 }}</td>
                            </tr>
                            <tr class="fw-bold">
                                <td class="fw-bold">Total Not Working Days</td>
                                @for ($i = 0; $i < 39; $i++)
                                    <td></td>
                                @endfor
                                <td>{{ $totalNotWorkingDays ?? 0 }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#year_filter').change(function() {
                var selectedYear = $(this).val();
                var currentYear = selectedYear;
                $('#current_year').text(currentYear);
                $(this).closest('form').submit();
            });
        });
        function exportTableToCSV(filename) {
            var csv = [];
            var headerCells = document.querySelectorAll('#myTable thead tr th');
            var headerRow = Array.from(headerCells).map(function(header) {
                return header.textContent.trim();
            });
            csv.push(headerRow.join(','));
            var rows = document.querySelectorAll('#myTable tbody tr');
            rows.forEach(function(row) {
                var rowData = [];
                var cells = row.querySelectorAll('td, th');
                cells.forEach(function(cell) {
                    if (cell.classList.contains('custom_td_ui')) {
                        var customDataLeft = cell.querySelector('.custom_td_left').textContent.trim();
                        var customDataRight = cell.querySelector('.custom_td_right').textContent.trim();
                        rowData.push(customDataLeft + ' | ' + customDataRight);
                    } else {
                        rowData.push(cell.textContent.trim());
                    }
                });
                csv.push(rowData.join(','));
            });
            var csvContent = "data:text/csv;charset=utf-8," + csv.join('\n');
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", filename);
            document.body.appendChild(link);
            link.click();
        }
    </script>
@endpush
