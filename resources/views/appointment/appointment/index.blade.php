@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box ">
                    <div class="header_btn_wrapper">
                        <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointments') }}</h3>
                        <div class="header_btns">
                            <div class="dropdown">
                                <button type="button" class="btn button_drop  dropdown-toggle borderRadius "    id="viwDropButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" > <i class="fa fa-eye me-3"></i>View Statistics</button>
                                <div class="dropdown-menu" aria-labelledby="viwDropButton">
                                    <div class=" " >
                                        <a href="{{ url('appointment_report_table?year=' . ($yearEstimation->year ?? date('Y'))) }}" class="btn border_btns">Appointment Report Table</a>
                                    </div>
                                    <div class="" >
                                        <a href="{{ url('sales_weekly?year=' . ($yearEstimation->year ?? date('Y'))) }}" class="btn border_btns">Sales Weekly</a>
                                    </div>
                                    <div class="" >
                                        <a href="{{ url('appointment_per_day?year=' . ($yearEstimation->year ?? date('Y'))) }}" class="btn border_btns">Appointment Per Day</a>
                                    </div>
                                </div>
                            </div>
                            @can('add-'.str_slug('Appointment'))
                                <a class="btn" data-bs-toggle="modal" data-bs-target="#createAppointmentModal" href="#!"><i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}</a>
                            @endcan
                            @if(request('appointment_type') == 'pending')
                                <a class="btn active" href="{{ url('/calendar_appointment_view?appointment_calender_type=pending') }}"><i class="icon-plus"></i> View Calendar</a>
                            @elseif(request('appointment_type') == 'won')
                                <a class="btn active" href="{{ url('/calendar_appointment_view?appointment_calender_type=won') }}"><i class="icon-plus"></i> View Calendar</a>
                            @elseif(request('appointment_type') == 'lost')
                                <a class="btn active" href="{{ url('/calendar_appointment_view?appointment_calender_type=lost') }}"><i class="icon-plus"></i> View Calendar</a>
                            @else
                                <a class="btn active" href="{{ url('/calendar_appointment_view') }}"><i class="icon-plus"></i> View Calendar</a>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table aligned_table  aligned_table2" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer  </th>
                                <th>Title</th>
                                <th>Appointment For </th>
                                <th>Location </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointment as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->getCustomer->name??"Not Available" }}</td>
                                    <td>{{ $item->title??"Not Available" }}</td>
                                    <td>{{ $item->getLead->title??"Not Available" }}</td>
                                    <td>{{ $item->location??"Not Available" }}</td>
                                    <td>
                                        @if(auth()->user()->hasRole('user'))
                                            @if($item->status==1)
                                                <a href="{{route('status_change_appointment',[$item->id, 0])}}" onclick="return confirmAndDisable(this);">
                                                    <div class="lead_check">
                                                        <div class="status_btn">
                                                            <badge class='badge pric_span btn-success badge-success'>Active </badge>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                                <a href="{{route('status_change_appointment',[$item->id, 1])}}" onclick="return confirmAndDisable(this);">
                                                    <div class="lead_check">
                                                        <div class="status_btn">
                                                            <badge class='badge pric_span btn-warning badge-warning text-white'>InActive</badge>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @else
                                            @if($item->status==1)
                                                <div class="lead_check">
                                                    <div class="status_btn">
                                                        <badge class='badge pric_span btn-success badge-success'>Active </badge>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="lead_check">
                                                    <div class="status_btn">
                                                        <badge class='badge pric_span btn-warning badge-warning text-white'>InActive</badge>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td  class="btn_td">
                                        @can('view-'.str_slug('Appointment'))
{{--                                            <a href="{{ url('view_lead/' . $item->appointment_for_lead_id) }}"--}}
                                            <a class="appointment_id"  appointment-id="{{$item->id}}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('edit-'.str_slug('Appointment'))
                                            <a href="{{ url('/appointment/appointment/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('delete-'.str_slug('Appointment'))
                                            <form method="POST"
                                                  action="{{ url('/appointment/appointment' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="button" class="btn delete_btn"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}"
                                                        onclick="showDeleteConfirmation(this)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $appointment->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="appointmentModal" class="main_modal modal aligned_modal" role="dialog">
    </div>
    <div id="createAppointmentModal" class="modal fade" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered my-0">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Create Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/appointment/appointment') }}" accept-charset="UTF-8"
                          class="form-horizontal MyAppointment" id="MyAppointment" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('appointment.appointment.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            @if(\Session::has('message'))
                $.toast({
                    heading: 'Success!',
                    position: 'top-center',
                    text: '{{session()->get('message')}}',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
            @endif
        })
        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });
        });
        $(document).on('click', '.appointment_id', function (e) {
            var id = $(this).attr('appointment-id');
            $.ajax({
                url: "{{route('view_appointment_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#appointmentModal').html(result);
                    $('#appointmentModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });

    </script>
    <script>
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
    </script>
@endpush
