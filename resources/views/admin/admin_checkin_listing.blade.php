{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />--}}
{{--@endpush--}}
{{--@section('content')--}}
{{--    <section class="staff_time_clock_sec">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="row">--}}
{{--                        <div class="white-box">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="data_range_filter">--}}
{{--                                    <form>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <input type="hidden" id="startDate" />--}}
{{--                                            <input type="hidden" id="endDate" />--}}
{{--                                            <input class="form-control" type="text" id="dateRange" placeholder="Select Date Range" />--}}
{{--                                        </div>--}}
{{--                                        <div  class="form-group">--}}
{{--                                            <select class="form-control" id="presetRange">--}}
{{--                                                <option value="" selected disabled>Select Date Range</option>--}}
{{--                                                <option value="today">Today</option>--}}
{{--                                                <option value="last7days">Last 7 Days</option>--}}
{{--                                                <option value="thisMonth">This Month</option>--}}
{{--                                                <option value="lastMonth">Last Month</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table" id="myTable">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>S No</th>--}}
{{--                                            <th>Date</th>--}}
{{--                                            <th>Check In Time</th>--}}
{{--                                            <th>Check Out Time</th>--}}
{{--                                            <th>Duration</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @php $counter = 1; @endphp--}}
{{--                                        @foreach($groupedData as $date => $checkIns)--}}
{{--                                            @php--}}
{{--                                                $firstCheckIn = $checkIns->first()->check_in ?? '';--}}
{{--                                                $lastCheckOut = $checkIns->last()->check_out ?? '';--}}
{{--                                                $lastCheckOutFormatted = $lastCheckOut ? date('h:i A', strtotime($lastCheckOut)) : '';--}}
{{--                                            @endphp--}}
{{--                                            <tr class="parent-row" data-date="{{ $date }}" style="cursor: pointer;">--}}
{{--                                                <td>{{ $counter++ }}</td>--}}
{{--                                                <td>{{ $date }}</td>--}}
{{--                                                <td>{{ $firstCheckIn ? date('h:i A', strtotime($firstCheckIn)) : '' }}</td>--}}
{{--                                                <td>{{ $lastCheckOutFormatted }}</td>--}}
{{--                                                <td>{{ $checkIns->first()->user->UserTime[$date] ?? '' }}</td>--}}
{{--                                                <td colspan="4">--}}
{{--                                                    <i class="fa-solid fa-circle-chevron-down chevron_down"></i>--}}
{{--                                                    <i class="fa-solid fa-circle-chevron-up chevron_up" style="display: none;"></i>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            @foreach($checkIns as $checkIn)--}}
{{--                                                <tr class="child-row" data-parent-date="{{ $date }}" style="display: none;">--}}
{{--                                                    <td><i class="fa-solid fa-circle cricle_dot"></i></td>--}}
{{--                                                    <td>{{ $date }}</td>--}}
{{--                                                    <td>{{ date('h:i A', strtotime($checkIn->check_in)) }}</td>--}}
{{--                                                    <td>{{ date('h:i A', strtotime($checkIn->check_out)) }}</td>--}}
{{--                                                    <td>{{ $checkIn->total_hours ?? '' }}</td>--}}
{{--                                                    <td class="btn_td">--}}
{{--                                                        @can('edit-' . str_slug('Staff'))--}}
{{--                                                            <button type="button" class="btn btn-sm edit_btn" data-clock-id="{{ $checkIn->id ?? '' }}">--}}
{{--                                                                <span class="fa fa-pencil-square-o"></span>--}}
{{--                                                            </button>--}}
{{--                                                        @endcan--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <div id="editClock" class="modal fade" tabindex="-1" aria-labelledby="editClock" aria-hidden="true" ></div>--}}
{{--@endsection--}}
{{--@push('js')--}}
{{--    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/moment/moment.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>--}}

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            // $('#myTable').DataTable({--}}
{{--            //     "aoColumnDefs": [{ "bSortable": false, "aTargets": [-1] }],--}}
{{--            //     "ordering": false,--}}
{{--            //     "paging": false--}}
{{--            // });--}}
{{--            // $(".dataTables_info").hide();--}}
{{--            $(".parent-row").on("click", function () {--}}
{{--                let date = $(this).data("date");--}}
{{--                let childRows = $(`.child-row[data-parent-date='${date}']`);--}}
{{--                let chevronDown = $(this).find(".chevron_down");--}}
{{--                let chevronUp = $(this).find(".chevron_up");--}}

{{--                childRows.slideToggle(300);--}}
{{--                chevronDown.toggle();--}}
{{--                chevronUp.toggle();--}}
{{--            });--}}
{{--        });--}}

{{--        $(document).ready(function () {--}}
{{--            // Initialize Date Range Picker--}}
{{--            $('#dateRange').daterangepicker({--}}
{{--                autoApply: true,--}}
{{--                locale: {--}}
{{--                    format: 'YYYY-MM-DD',--}}
{{--                    cancelLabel: 'Clear' // Adds a "Clear" button--}}
{{--                },--}}
{{--                opens: 'left',--}}
{{--                autoUpdateInput: false // Prevents automatic input value update--}}
{{--            }, function(start, end, label) {--}}
{{--                $('#startDate').val(start.format('YYYY-MM-DD'));--}}
{{--                $('#endDate').val(end.format('YYYY-MM-DD'));--}}
{{--                $('#dateRange').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
{{--                table.draw();--}}
{{--            });--}}

{{--            // Set default placeholder text--}}
{{--            $('#dateRange').val('').attr("placeholder", "Select Range");--}}

{{--            // Handle clearing the input field when "Clear" is clicked--}}
{{--            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {--}}
{{--                $(this).val('').attr("placeholder", "Select Range");--}}
{{--                $('#startDate, #endDate').val(''); // Clear hidden inputs--}}
{{--                table.draw();--}}
{{--            });--}}

{{--            // Handle validation to avoid "Invalid date"--}}
{{--            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {--}}
{{--                var start = picker.startDate.format('YYYY-MM-DD');--}}
{{--                var end = picker.endDate.format('YYYY-MM-DD');--}}

{{--                if (start && end && start !== 'Invalid date' && end !== 'Invalid date') {--}}
{{--                    $(this).val(start + ' to ' + end);--}}
{{--                } else {--}}
{{--                    $(this).val('').attr("placeholder", "Select Range");--}}
{{--                }--}}
{{--            });--}}



{{--            // Initialize DataTable--}}
{{--            var table = $('#myTable').DataTable({--}}
{{--                "aoColumnDefs": [{ "bSortable": false, "aTargets": [-1] }],--}}
{{--                "ordering": false,--}}
{{--                "paging": false,--}}
{{--                // "searching": false,--}}
{{--            });--}}

{{--            // Hide DataTables info text--}}
{{--            $(".dataTables_info").hide();--}}

{{--            // Date range filter logic for DataTable--}}
{{--            $.fn.dataTable.ext.search.push(--}}
{{--                function (settings, data, dataIndex) {--}}
{{--                    var min = $('#startDate').val();--}}
{{--                    var max = $('#endDate').val();--}}
{{--                    var dateColumn = data[1]; // Assuming the date is in the second column (index 1)--}}

{{--                    // Convert the table date column to a date object (parse it to ensure it matches the format)--}}
{{--                    var rowDate = new Date(dateColumn);--}}
{{--                    if (isNaN(rowDate.getTime())) return false;  // If the date is not valid, exclude the row--}}

{{--                    // Filter by min date--}}
{{--                    if (min && !max) {--}}
{{--                        return rowDate >= new Date(min);--}}
{{--                    }--}}

{{--                    // Filter by max date--}}
{{--                    if (!min && max) {--}}
{{--                        return rowDate <= new Date(max);--}}
{{--                    }--}}

{{--                    // Filter by both min and max dates--}}
{{--                    if (min && max) {--}}
{{--                        return rowDate >= new Date(min) && rowDate <= new Date(max);--}}
{{--                    }--}}

{{--                    return true;--}}
{{--                }--}}
{{--            );--}}

{{--            // Handle preset date ranges--}}
{{--            $('#presetRange').change(function () {--}}
{{--                var preset = $(this).val();--}}
{{--                var today = new Date();--}}
{{--                var startDate, endDate;--}}

{{--                switch (preset) {--}}
{{--                    case 'today':--}}
{{--                        startDate = today;--}}
{{--                        endDate = today;--}}
{{--                        break;--}}
{{--                    case 'last7days':--}}
{{--                        startDate = new Date(today);--}}
{{--                        startDate.setDate(today.getDate() - 7);--}}
{{--                        endDate = today;--}}
{{--                        break;--}}
{{--                    case 'thisMonth':--}}
{{--                        startDate = new Date(today.getFullYear(), today.getMonth(), 1);--}}
{{--                        endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);--}}
{{--                        break;--}}
{{--                    case 'lastMonth':--}}
{{--                        startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);--}}
{{--                        endDate = new Date(today.getFullYear(), today.getMonth(), 0);--}}
{{--                        break;--}}
{{--                    default:--}}
{{--                        startDate = '';--}}
{{--                        endDate = '';--}}
{{--                }--}}

{{--                // Update the date range input and trigger table redraw--}}
{{--                $('#dateRange').data('daterangepicker').setStartDate(startDate);--}}
{{--                $('#dateRange').data('daterangepicker').setEndDate(endDate);--}}
{{--                $('#startDate').val(formatDate(startDate));--}}
{{--                $('#endDate').val(formatDate(endDate));--}}
{{--                table.draw();--}}
{{--            });--}}

{{--            // Function to format the date in yyyy-mm-dd format--}}
{{--            function formatDate(date) {--}}
{{--                if (date) {--}}
{{--                    var d = new Date(date);--}}
{{--                    return d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2, '0') + '-' + d.getDate().toString().padStart(2, '0');--}}
{{--                }--}}
{{--                return '';--}}
{{--            }--}}
{{--        });--}}





{{--    </script>--}}

{{--    <script>--}}
{{--        // $(document).ready(function () {--}}
{{--        //     $('.parent-row').on('click', function () {--}}
{{--        //         var date = $(this).data('date');--}}
{{--        //         var childRows = $('.child-row[data-parent-date="' + date + '"]');--}}
{{--        //         childRows.toggle();--}}
{{--        //         $(this).toggleClass('highlighted');--}}
{{--        //     });--}}
{{--        // });--}}
{{--        $(document).on('click', '.edit_btn', function (e) {--}}
{{--            cancelPendingRequest();--}}
{{--            var userId = $(this).attr('data-clock-id');--}}
{{--            $.ajax({--}}
{{--                url: "{{route('edit_checkin_modal')}}",--}}
{{--                type: 'Get',--}}
{{--                data: {--}}
{{--                    'id': userId,--}}
{{--                },--}}
{{--                success: function (result) {--}}
{{--                    $('#editClock').html(result);--}}
{{--                    $('#editClock').modal('show');--}}
{{--                },--}}
{{--                error: function (e) {--}}
{{--                    console.log(e.status);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
{{--@endpush--}}


@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Admins') }}</h3>
                        @can('add-'.str_slug('Staff'))
                            <a class="btn btn-success pull-right" href="{{ url('/staff/staff/create') }}">Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff') }} <i class="icon-plus"></i> </a>
                        @endcan
                        <div class="clearfix"></div>
                        <hr>
{{--                        <div class="button_logo">--}}
{{--                            <button type="button" class="btn borderRadius delete_inbox_email green_btn" data-notification-id="" id="btn-delete-multiple">--}}
{{--                                <span class="fa fa-trash"></span>--}}
{{--                            </button>--}}
{{--                            <button type="button" class="btn green_btn borderRadius add_job_note_modal_btn" > <span class="fa fa-envelope"></span> </button>--}}
{{--                            @can('add-'.str_slug('Announcement'))--}}
{{--                                <button type="button" class="btn green_btn borderRadius add_announcement_btn" > <span class="fa fa-bell"></span> </button>--}}
{{--                            @endcan--}}
{{--                        </div>--}}
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
{{--                                    <th>--}}
{{--                                        <div class="custom_checkbox">--}}
{{--                                            <input class="noti_check" type="checkbox" name="notify_check" id="notify_check">--}}
{{--                                            <label for="notify_check"></label>--}}
{{--                                        </div>--}}
{{--                                        --}}{{--                                        <input class="noti_check" type="checkbox" name="notify_check" id="notify_check">--}}
{{--                                    </th>--}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($staff as $item)
                                    <tr class="staff_check">
{{--                                        <td>--}}
{{--                                            <div class="custom_checkbox">--}}
{{--                                                <input class="noti_check noti_checks" type="checkbox" data-staffCheck-id="{{ $item->id }}">--}}
{{--                                                <label for="notify_check_{{ $item->id }}"></label>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
                                        <td>{{ $item->name??"Not Available" }}</td>
                                        <td>{{ $item->email??"Not Available" }}</td>
                                        <td>{{ $item->profile->phone??"Not Available" }}</td>
                                        {{--                                    <td>{!! ($item->status==1)?"<badge class='badge badge-success'>Active</badge>":"<badge class='badge badge-warnning'>Inactive</badge>" !!}</td>--}}
                                        <td>
                                            @if($item->status == 1)
                                                <a href="{{ route('change_staff_status', [$item->id, 0]) }}" onclick="return confirmAndDisable(this);">
                                                    <div class="lead_check">
                                                        <div class="status_btn">
                                                            <label for="status-{{ $item->id }}">
                                                                <badge class="badge badge-success">
                                                                    Active
                                                                </badge>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                                <a href="{{ route('change_staff_status', [$item->id, 1]) }}" onclick="return confirmAndDisable(this);">
                                                    <div class="lead_check">
                                                        <div class="status_btn">
                                                            <label for="status-{{ $item->id }}">
                                                                <badge class="badge badge-warning">
                                                                    Inactive
                                                                </badge>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="btn_td">
                                            @can('view-'.str_slug('Staff'))
                                                <a href="{{ url('/staff/staff/' . $item->id) }}"
                                                   title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff') }}">
                                                    <button class="btn view_btn btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('view-'.str_slug('Staff'))
                                                <a href="{{ url('staff_time_clock/' . $item->id) }}" class="btn view_btn btn-sm" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Clock') }}">
                                                    <i class="fa fa-clock" aria-hidden="true"></i>
                                                </a>
                                            @endcan
{{--                                            @can('edit-'.str_slug('Staff'))--}}
                                                <a href="{{ url('/staff/staff/' . $item->id . '/edit') }}"
                                                   title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff') }}">
                                                    <button class="btn edit_btn btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                </a>
{{--                                            @endcan--}}
{{--                                            @can('delete-'.str_slug('Staff'))--}}
{{--                                                <form method="POST"--}}
{{--                                                      action="{{ url('/staff/staff' . '/' . $item->id) }}"--}}
{{--                                                      accept-charset="UTF-8" style="display:inline" class="delete-form">--}}
{{--                                                    {{ method_field('DELETE') }}--}}
{{--                                                    {{ csrf_field() }}--}}
{{--                                                    <button type="button" class="btn delete_btn btn-sm"--}}
{{--                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff') }}"--}}
{{--                                                            onclick="showDeleteConfirmation(this)"><i class="fa fa-trash" aria-hidden="true"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            @endcan--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <div class="pagination-wrapper"> {!! $staff->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="addEmails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Emails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal emailValidate" method="get" id="email_form" action="{{route('send_email_to_users')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" id="subject" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Attachments *</label>
                                        <div class="input_fields_wrap_right">
                                            <div class="custom_add_inputs">
                                                <input type="file" name="mail_attachment[]" placeholder="Subject" class="form-control" value="" />
                                                <button class="btn remove_button" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                            <button class="add_field_button btn btn-warning " type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recipient-name" class="input_labels control-label">Description:</label>
                                        <textarea class="form-control" rows="5" name="description" type="textarea" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class=" d-flex justify-content-center ">
                                            <button class="btn green_btn borderRadius add_task_modal_btn " type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="addAnnouncement" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Enter Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal validateAnnoucement" method="POST" id="add_announcement_form" action="{{route('annoucement_assign_to_staff')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 control-label text_align_disabling">
                                    <label for="announcement_description">{{ 'Description' }}</label>

                                    <textarea class="form-control " rows="5" name="description" type="textarea" id="announcement_description" ></textarea>
                                </div>


                                <div class="col-md-12 text-center">
                                    <input class="btn green_btn_description" type="submit" value="Create">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>






    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        //  ===============  CK editor JS  ==================

        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
        $(document).ready(function() {
            CKEDITOR.replace('announcement_description');
        });
        $(document).ready(function () {
            $('#notify_check').change(function () {
                if (this.checked) {
                    $('.noti_checks').prop('checked', true);
                } else {
                    $('.noti_checks').prop('checked', false);
                }
            });
        });

        {{--    $(document).ready(function () {--}}

        {{--        @if(\Session::has('message'))--}}
        {{--$.toast({--}}
        {{--            heading: 'Success!',--}}
        {{--            position: 'top-center',--}}
        {{--            text: '{{session()->get('message')}}',--}}
        {{--            loaderBg: '#ff6849',--}}
        {{--            icon: 'success',--}}
        {{--            hideAfter: 3000,--}}
        {{--            stack: 6--}}
        {{--        });--}}
        {{--        @endif--}}
        {{--    });--}}

        function confirmAndDisable(link) {
            event.preventDefault();
            if (link.classList.contains('disabled')) {
                return false; // Link is already disabled
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    link.classList.add('disabled'); // Disable the link
                    window.location = link.href;
                }
            });
        }


        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
        $(document).on('click', '#btn-delete-multiple', function (event) {
            event.preventDefault();
            var selectedStaffCount = $('.noti_checks:checked').length;

            if (selectedStaffCount === 0) {
                Swal.fire('Warning!', 'Please select at least one staff member to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Staff?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedStaffs();
                }
            });
        }

        function deleteSelectedStaffs() {
            var selectedStaffIDs = [];
            $('.noti_checks:checked').each(function () {
                selectedStaffIDs.push($(this).attr('data-staffCheck-id'));
            });
            $.ajax({
                url: "{{ route('staff_multiple_delete') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: selectedStaffIDs
                },

                success: function(response) {
                    selectedStaffIDs.forEach(function (id) {
                        $('.noti_checks[data-staffCheck-id="' + id + '"]').closest('.staff_check').remove();
                    });
                    if (response == "success") {
                        Swal.fire({
                            title: "Selected Staffs Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    console.log('Delete IDS:', selectedStaffIDs);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }


        $(document).on('click','.add_job_note_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-staffCheck-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select staff first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addEmails').modal('show');
            }
        });

        $(document).on('click', '.add_announcement_btn', function (e) {
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function () {
                var contact_id = $(this).attr('data-staffCheck-id');
                user_ids.push(contact_id);
            });

            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select staff first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addAnnouncement').modal('show');

                // Append hidden input fields after modal is shown
                $.each(user_ids, function (index, contact_id) {
                    $('#add_announcement_form').append($('<input>', { type: 'hidden', name: 'user_ids[]', value: contact_id }));
                });
            }
        });

        $(document).ready(function() {
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "This field is required");
            $('.emailValidate').validate({
                ignore: [],
                rules: {
                    subject: {
                        required: true
                    },
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    subject: {
                        required: "Subject required."
                    },
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function() {
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "This field is required");
            $('.validateAnnoucement').validate({
                ignore: [],
                rules: {
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    </script>

@endpush

