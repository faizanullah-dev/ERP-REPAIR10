@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{asset('plugins/components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body .lead-stage tbody tr td { border: 0; height: 80px; }
        .lead-stage tr { border-bottom: 1px solid #e5ebec; }
        .cstm-switch input { opacity: 0; width: 0; height: 0; }
        .cstm-switch input:checked + .cstm-slider { background-color: #00a02c; }
        .cstm-switch input:focus + .cstm-slider { box-shadow: 0 0 1px #00a02c; }
        .cstm-switch { position: relative; display: inline-block; width: 60px; height: 34px; }
        .cstm-switch input:checked + .cstm-slider:before { -webkit-transform: translateX(26px); -ms-transform: translateX(26px); transform: translateX(26px); }
        .cstm-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; border-radius: 34px; background-color: #ccc; -webkit-transition: .4s; transition: .4s; }
        .cstm-slider:before { position: absolute; content: ""; height: 26px; width: 26px; left: 4px; bottom: 4px; border-radius: 50%; background-color: white; -webkit-transition: .4s; transition: .4s; }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}</h3>
                    @can('add-'.str_slug('Stage'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/stage/stage/create') }}">
                                <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}
                        </a>--}}

                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addStage" href="#">
                            <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="button_logo">
                        <button type="button" class="btn borderRadius delete_inbox_email" data-notification-id="" id="btn-delete-multiple">
                            <span class="fa fa-trash-o"></span>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <div class="dataTables_wrapper">
                            <table class="table lead-stage" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <input class="noti_check" type="checkbox" name="notify_check" id="notify_check">
                                    </th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Colour</th>
                                    <th>Contract</th>
                                    <th>Finance</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="sortable">
                                @php $index=1;@endphp
                                @foreach($stage->sortBy('position') as $item)
                                    <tr class="sortable-item" data-start-index="{{$index++}}" id="{{$item->id}}">
                                        <td>
                                            <input class="noti_check noti_checks" type="checkbox" data-stageCheck-id="{{ $item->id }}">
                                        </td>
                                        <td class="stage-number">{{ $loop->iteration??$item->id }}</td>
                                        <td>{{ $item->name??"Not Available" }}</td>
                                        <td>
                                            <span style="width: 20px; height: 20px; border-radius: 10px; display: block; margin: 0 auto; background-color: {{ $item->colour_id }}; border: 1px solid black;"></span>
                                        </td>
                                        <td>
                                            <label class="cstm-switch">
                                                <input type="radio"
                                                       @if(isset($item) && $item->contract == 1) checked @endif
                                                       class="contract js-switch"
                                                       name="contract"
                                                       data-contract-id="{{ $item->id }}"
                                                       data-color="#00a02c"/>
                                                <span class="cstm-slider"></span>
                                            </label>

                                        </td>
                                        <td>
                                            <label class="cstm-switch">
                                                <input type="radio"
                                                       @if(isset($item) && $item->finance == 1) checked @endif
                                                       class="finance js-switch"
                                                       name="finance"
                                                       data-finance-id="{{ $item->id }}"
                                                       data-color="#00a02c"/>
                                                <span class="cstm-slider"></span>
                                            </label>
                                        </td>
                                        <td>
                                            @if(auth()->user()->hasRole('user'))
                                                @if($item->status==1)
                                                    <a href="{{route('status_change_stages',[$item->id, 0])}}" onclick="return confirmAndDisable(this);">
                                                        <div class="lead_check">
                                                            <div class="status_btn">
                                                                <badge class='badge pric_span btn-success badge-success'>Active </badge>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="{{route('status_change_stages',[$item->id, 1])}}" onclick="return confirmAndDisable(this);">
                                                        <div class="lead_check">
                                                            <div class="status_btn">
                                                                <badge class='badge pric_span btn-warning badge-warning'>InActive</badge>
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
                                                            <badge class='badge pric_span btn-warning badge-warning'>InActive</badge>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="btn_td">
                                            @can('view-'.str_slug('Stage'))
                                                <a data-view-id="{{ $item->id }}" class="btn-view-modal" xhref="{{ url('/stage/stage/' . $item->id) }}"
                                                   title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}">
                                                    <button class="btn view_btn btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('edit-'.str_slug('Stage'))
                                                <a data-edit-id="{{ $item->id }}" class="btn-edit-modal" xhref="{{ url('/stage/stage/' . $item->id . '/edit') }}"
                                                   title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}">
                                                    <button class="btn edit_btn btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('delete-'.str_slug('Stage'))
                                                <form method="POST" action="{{ url('/stage/stage' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn delete_btn btn-sm"
                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-wrapper"> {!! $stage->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addStage" class="modal fade" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
                </div>
                <div class="modal-body">

                    <div class="clearfix"></div>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/stage/stage') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="stage">
                        {{ csrf_field() }}

                        @include ('stage.stage.form')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editStage" class="modal fade" tabindex="-1"  aria-hidden="true" ></div>

    <div id="viewStage" class="modal fade lead-view-modal" tabindex="-1" aria-hidden="true"></div>
@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
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

        //        $(function () {
        //            $('#myTable').DataTable({
        //                'aoColumnDefs': [{
        //                    'bSortable': false,
        //                    'aTargets': [-1] /* 1st one, start by the right */
        //                }]
        //            });
        //
        //        });
        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var sortedData = $(this).sortable('toArray');
                    updatePositions(sortedData);
                },
                placeholder: "sortable-item",
                forcePlaceholderSize: true
            }).disableSelection();
            function updatePositions(sortedData) {
                $.ajax({
                    url: "{{ route('update_positions') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        positions: sortedData
                    },
                    success: function(response) {
                        $(".stage-number").each(function(index) {
                            $(this).html(index + 1);
                        });
                        console.log("Success!", "Stages updated successfully.", "success");
                    },
                    error: function(xhr, status, error) {
                        console.log("Error updating positions: " + error);
                    }
                });
            }
        });
        $(document).ready(function() {
            $(document).on('click', '#btn-delete-multiple', function(e) {
                e.preventDefault();
                var user_ids = [];
                $('.noti_checks:checked').each(function() {
                    var contact_id = $(this).attr('data-stageCheck-id');
                    user_ids.push(contact_id);
                });
                if (user_ids.length === 0) {
                    Swal.fire({
                        title: 'Please select stages first',
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        timer: 5000,
                    });
                } else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to delete the selected stages?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{url('stage/multiple/delete')}}",
                                type: 'GET',
                                data: {
                                    ids: user_ids
                                },
                                success: function(response) {
                                    if (response.success) { // Check if response.success is true
                                        Swal.fire({
                                            title: "Selected Stage Deleted Successfully",
                                            icon: "success",
                                            timer: 5000,
                                            showConfirmButton: false
                                        }).then(() => {
                                            location.reload(); // Reload the page after the SweetAlert closes
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Something went wrong",
                                            text: "Error", // Optionally display the error message from the server
                                            icon: "error",
                                            showConfirmButton: true
                                        });
                                    }
                                },
                            });
                        }
                    });
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
        $(document).ready(function() {
            $(".js-switch").on("change", function() {
                var contractId = $(this).attr('data-contract-id');
                var financeId = $(this).attr('data-finance-id');

                // Determine the selected state for contract and finance
                var contract = $('input[name="contract"][data-contract-id="'+contractId+'"]').prop('checked') ? 1 : 0;
                var finance = $('input[name="finance"][data-finance-id="'+financeId+'"]').prop('checked') ? 1 : 0;

                // If contract is checked, uncheck finance
                if (contract === 1) {
                    $('input[name="finance"][data-finance-id="'+financeId+'"]').prop('checked', false);
                    finance = 0;  // Set finance to 0
                }

                // If finance is checked, uncheck contract
                if (finance === 1) {
                    $('input[name="contract"][data-contract-id="'+contractId+'"]').prop('checked', false);
                    contract = 0;  // Set contract to 0
                }

                // Get CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Send the AJAX request to update the stage
                $.ajax({
                    url: "{{ route('update_stage_automation') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        contractId: contractId,
                        financeId: financeId,
                        contract: contract,
                        finance: finance
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.message);  // Handle success
                        } else {
                            console.log(response.message);  // Handle failure
                        }
                    },
                    error: function(error) {
                        console.error('Error in updating stage automation:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.btn-edit-modal', function (e) {
            var id = $(this).data('edit-id');
            $.ajax({
                url: "{{route('edit_stage_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editStage').html(result);
                    $('#editStage').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });

        $(document).on('click', '.btn-view-modal', function (e) {
            var id = $(this).data('view-id');
            $.ajax({
                url: "{{route('view_stage_modal')}}",
                type: 'get',
                data: {
                    'id':id,
                },
                success: function (result) {
                    $('#viewStage').html(result);
                    $('#viewStage').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>
@endpush
