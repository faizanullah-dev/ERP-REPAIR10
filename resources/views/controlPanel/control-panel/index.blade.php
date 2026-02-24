@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
        }

        input:checked + .slider {
            background-color: #4CAF50;
        }

        input:checked + .slider:before {
            transform: translateX(14px);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ControlPanel') }}</h3>
{{--                    @can('add-'.str_slug('ControlPanel'))--}}
{{--                        <a class="btn btn-success pull-right" href="{{ url('/controlPanel/control-panel/create') }}"><i--}}
{{--                                    class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ControlPanel') }}</a>--}}
{{--                    @endcan--}}
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>Module</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($controlpanel as $item)
                                <tr>
                                    <td>{{ $item->module }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status-toggle" data-id="{{ $item->id }}" {{ $item->status == 'active' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $controlpanel->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
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
    </script>

    <script>
        $(document).ready(function() {
            $('.status-toggle').change(function() {
                var $checkbox = $(this);
                var status = $checkbox.prop('checked') ? 'active' : 'inactive';
                var controlPanelId = $checkbox.data('id');

                $checkbox.prop('disabled', true);

                $.ajax({
                    url: "{{url('update_control')}}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: controlPanelId,
                        status: status
                    },
                    success: function(response) {
                        if (response.message === 'success') {
                            Swal.fire('Control Updated Successfully');
                        } else {
                            Swal.fire('Failed to update control');
                        }
                        $checkbox.prop('disabled', false);
                    },
                    error: function() {
                        alert('Error while updating status!');
                        $checkbox.prop('disabled', false);
                    }
                });
            });
        });
    </script>

@endpush
