@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@section('content')
    <section class="staff_time_clock_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="white-box">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left hourly_rate_status ">
                                        <h5 class="box-title">{{ $staff->name??"" }} </h5>
                                        @php
                                            $staffFinance = json_decode($staff->staffPosition, true) ?? [];
                                            $compensation = json_decode($staffFinance['compensation_record'] ?? '[]', true);
                                            $type = $staffFinance['staff_compensation'] ?? '';
                                        @endphp
                                        @if ($type === 'hourly')
                                            @php $hourly = $compensation['hourly'] ?? []; @endphp
                                            <h5>Compensation: Hours</h5>
                                            <h6 class="green_text">${{ $hourly['hours_per_week'] }}/hrs</h6>
                                            <input class="weekly_pay" type="hidden" value="{{ $hourly['pay'] }}">
                                        @elseif($type === 'salary')
                                            @php $salary = $compensation['salary'] ?? []; @endphp
                                            <h5>Compensation: Salary</h5>
                                            <h6 class="green_text">${{ $salary['pay'] }} pay per day</h6>
                                            <input class="per_day_pay" type="hidden" value="{{ $salary['pay'] }}">
                                        @elseif($type === 'commission')
                                            @php $commission = $compensation['commission'] ?? []; @endphp
                                            <h5>Compensation: Commission</h5>
                                            <h6 class="green_text">${{ number_format($commission['rate'] ?? 0, 2) }} rate</h6>
                                        @elseif($type === 'base_commission')
                                            @php $base_commission = $compensation['base_commission'] ?? []; @endphp
                                            <h5>Compensation: Base + Commission</h5>
                                            <h6 class="green_text">${{ $base_commission['pay'] }} pay per day</h6>
                                            <input class="bcommission_per_day" type="hidden" value="{{ $base_commission['pay'] }}">
                                        @else
                                            <h6 class="green_text">00</h6>
                                        @endif
                                    </div>
                                    <div class="white-box-header-right staff_clock_cards">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h5>Current Month Hours</h5>
                                                    <h6 class="green_text">{{ $staff->CurrentMonthHours??'' }} hrs</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h5>Current Week Hours</h5>
                                                    <h6 class="green_text current_week_hours">{{ $staff->CurrentWeekHours??'' }} hrs</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h5>Estimated Weekly Payout</h5>
                                                    @if ($type === 'hourly')
                                                        <h6 class="green_text" id="total_weekly_hours_pay"></h6>
                                                    @elseif($type === 'salary')
                                                        <h6 class="green_text" id="total_weekly_salary_pay"></h6>
                                                    @elseif($type === 'commission')
                                                        <h6 class="green_text" id="total_weekly_commission_pay"></h6>
                                                    @elseif($type === 'base_commission')
                                                        <h6 class="green_text" id="total_weekly_base_commission"></h6>
                                                    @else
                                                        <h6 class="green_text">$00</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="data_range_filter">
                                    <form>
                                        <div class="form-group">
                                            <input type="hidden" id="startDate" />
                                            <input type="hidden" id="endDate" />
                                            <input class="form-control" type="text" id="dateRange" placeholder="Select Date Range" />
                                        </div>
                                        <div  class="form-group">
                                            <select class="form-control" id="presetRange">
                                                <option value="" selected disabled>Select Date Range</option>
                                                <option value="today">Today</option>
                                                <option value="last7days">Last 7 Days</option>
                                                <option value="thisMonth">This Month</option>
                                                <option value="lastMonth">Last Month</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Date</th>
                                            <th>Check In Time</th>
                                            <th>Check Out Time</th>
                                            <th>Duration</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($groupedData as $date => $checkIns)
                                            @php
                                                $firstCheckIn = $checkIns->first()->check_in ?? '';
                                                $lastCheckOut = $checkIns->last()->check_out ?? '';
                                                $lastCheckOutFormatted = $lastCheckOut ? date('h:i A', strtotime($lastCheckOut)) : '';
                                            @endphp
                                            <tr class="parent-row" data-date="{{ $date }}" style="cursor: pointer;">
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $date }}</td>
                                                <td>{{ $firstCheckIn ? date('h:i A', strtotime($firstCheckIn)) : '' }}</td>
                                                <td>{{ $lastCheckOutFormatted }}</td>
                                                <td>{{ $checkIns->first()->user->UserTime[$date] ?? '' }}</td>
                                                <td colspan="4">
                                                    <i class="fa-solid fa-circle-chevron-down chevron_down"></i>
                                                    <i class="fa-solid fa-circle-chevron-up chevron_up" style="display: none;"></i>
                                                </td>
                                            </tr>
                                            @foreach($checkIns as $checkIn)
                                                <tr class="child-row" data-parent-date="{{ $date }}" style="display: none;">
                                                    <td><i class="fa-solid fa-circle cricle_dot"></i></td>
                                                    <td>{{ $date }}</td>
                                                    <td>{{ date('h:i A', strtotime($checkIn->check_in)) }}</td>
                                                    <td>{{ date('h:i A', strtotime($checkIn->check_out)) }}</td>
                                                    <td>{{ $checkIn->total_hours ?? '' }}</td>
                                                    <td class="btn_td">
                                                        @can('edit-' . str_slug('Staff'))
                                                            <button type="button" class="btn btn-sm edit_btn" data-clock-id="{{ $checkIn->id ?? '' }}">
                                                                <span class="fa fa-pencil-square-o"></span>
                                                            </button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="editClock" class="modal fade" tabindex="-1" aria-labelledby="editClock" aria-hidden="true" ></div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>
    <script>
        function calculateTotalHours(time) {
            var timeParts = time.replace('hrs', '').trim().split(':');
            var hours = parseInt(timeParts[0], 10), minutes = parseInt(timeParts[1], 10), seconds = parseInt(timeParts[2], 10);
            return hours + minutes / 60 + seconds / 3600;
        }

        function updateWeeklyPay() {
            var totalHours = calculateTotalHours($('.current_week_hours').text());
            var pay = parseFloat($('.weekly_pay').val()) || 0;
            var totalAmount = totalHours * pay;
            $('#total_weekly_hours_pay').text('$' + totalAmount.toFixed(2));
        }

        function updateSalaryPay() {
            var totalHours = calculateTotalHours($('.current_week_hours').text());
            var perDayPay = parseFloat($('.per_day_pay').val()) || 0;
            var totalAmount = perDayPay * totalHours;
            $('#total_weekly_salary_pay').text('$' + totalAmount.toFixed(2));
        }

        function calculateBaseCommission() {
            var baseCommissionPerDay = parseFloat($('.bcommission_per_day').val()) || 0; // Base Commission Pay per day
            var totalDaysWorked = 0;

            $(".parent-row").each(function() {
                var date = $(this).data('date');
                var totalDuration = $(this).next('.child-row').find("td").eq(4).text(); // Get the duration column

                // Check if the duration is greater than or equal to 8 hours
                var durationParts = totalDuration.split(':');
                var hours = parseInt(durationParts[0], 10);
                var minutes = parseInt(durationParts[1], 10);
                var seconds = parseInt(durationParts[2], 10);
                var totalDurationInHours = hours + minutes / 60 + seconds / 3600;

                if (totalDurationInHours >= 8) {
                    totalDaysWorked++;
                }
            });

            var totalBaseCommission = totalDaysWorked * baseCommissionPerDay;
            $('#total_weekly_base_commission').text('$' + totalBaseCommission.toFixed(2));
        }
        $(document).ready(function () {
                updateWeeklyPay();
                updateSalaryPay();
                calculateBaseCommission();

            $(".parent-row").on("click", function () {
                let date = $(this).data("date");
                let childRows = $(`.child-row[data-parent-date='${date}']`);
                let chevronDown = $(this).find(".chevron_down");
                let chevronUp = $(this).find(".chevron_up");
                childRows.slideToggle(300);
                chevronDown.toggle();
                chevronUp.toggle();
            });
        });

        $(document).ready(function () {
            // Initialize Date Range Picker
            $('#dateRange').daterangepicker({
                autoApply: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear' // Adds a "Clear" button
                },
                opens: 'left',
                autoUpdateInput: false // Prevents automatic input value update
            }, function(start, end, label) {
                $('#startDate').val(start.format('YYYY-MM-DD'));
                $('#endDate').val(end.format('YYYY-MM-DD'));
                $('#dateRange').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                table.draw();
            });

            // Set default placeholder text
            $('#dateRange').val('').attr("placeholder", "Select Range");

            // Handle clearing the input field when "Clear" is clicked
            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('').attr("placeholder", "Select Range");
                $('#startDate, #endDate').val(''); // Clear hidden inputs
                table.draw();
            });

            // Handle validation to avoid "Invalid date"
            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                var start = picker.startDate.format('YYYY-MM-DD');
                var end = picker.endDate.format('YYYY-MM-DD');

                if (start && end && start !== 'Invalid date' && end !== 'Invalid date') {
                    $(this).val(start + ' to ' + end);
                } else {
                    $(this).val('').attr("placeholder", "Select Range");
                }
            });



            // Initialize DataTable
            var table = $('#myTable').DataTable({
                "aoColumnDefs": [{ "bSortable": false, "aTargets": [-1] }],
                "ordering": false,
                "paging": false,
                // "searching": false,
            });

            // Hide DataTables info text
            $(".dataTables_info").hide();

            // Date range filter logic for DataTable
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#startDate').val();
                    var max = $('#endDate').val();
                    var dateColumn = data[1]; // Assuming the date is in the second column (index 1)

                    // Convert the table date column to a date object (parse it to ensure it matches the format)
                    var rowDate = new Date(dateColumn);
                    if (isNaN(rowDate.getTime())) return false;  // If the date is not valid, exclude the row

                    // Filter by min date
                    if (min && !max) {
                        return rowDate >= new Date(min);
                    }

                    // Filter by max date
                    if (!min && max) {
                        return rowDate <= new Date(max);
                    }

                    // Filter by both min and max dates
                    if (min && max) {
                        return rowDate >= new Date(min) && rowDate <= new Date(max);
                    }

                    return true;
                }
            );

            // Handle preset date ranges
            $('#presetRange').change(function () {
                var preset = $(this).val();
                var today = new Date();
                var startDate, endDate;

                switch (preset) {
                    case 'today':
                        startDate = today;
                        endDate = today;
                        break;
                    case 'last7days':
                        startDate = new Date(today);
                        startDate.setDate(today.getDate() - 7);
                        endDate = today;
                        break;
                    case 'thisMonth':
                        startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                        endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        break;
                    case 'lastMonth':
                        startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                        endDate = new Date(today.getFullYear(), today.getMonth(), 0);
                        break;
                    default:
                        startDate = '';
                        endDate = '';
                }

                // Update the date range input and trigger table redraw
                $('#dateRange').data('daterangepicker').setStartDate(startDate);
                $('#dateRange').data('daterangepicker').setEndDate(endDate);
                $('#startDate').val(formatDate(startDate));
                $('#endDate').val(formatDate(endDate));
                table.draw();
            });

            // Function to format the date in yyyy-mm-dd format
            function formatDate(date) {
                if (date) {
                    var d = new Date(date);
                    return d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2, '0') + '-' + d.getDate().toString().padStart(2, '0');
                }
                return '';
            }
        });

        // $(document).ready(function () {
        //     $('.parent-row').on('click', function () {
        //         var date = $(this).data('date');
        //         var childRows = $('.child-row[data-parent-date="' + date + '"]');
        //         childRows.toggle();
        //         $(this).toggleClass('highlighted');
        //     });
        // });
        $(document).on('click', '.edit_btn', function (e) {
            cancelPendingRequest();
            var userId = $(this).attr('data-clock-id');
            $.ajax({
                url: "{{route('edit_checkin_modal')}}",
                type: 'Get',
                data: {
                    'id': userId,
                },
                success: function (result) {
                    $('#editClock').html(result);
                    $('#editClock').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });

    </script>
@endpush
