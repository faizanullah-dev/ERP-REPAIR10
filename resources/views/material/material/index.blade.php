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
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}</h3>
                    @can('add-'.str_slug('Material'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/material/material/create') }}">--}}
                            {{--<i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}--}}
                        {{--</a>--}}

                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addMaterial" href="#">
                            <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                {{--<th>Lead</th>--}}
                                <th>Material Name</th>
                                <th>Price/Unit</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($material as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    {{--<td>{{ $item->getLead->title??"" }}</td>--}}
                                    <td>{{ $item->name??"" }}</td>
                                    <td>{{ $item->price??"" }}</td>
                                    <td>
                                        @if($item->status==1)
                                            <a href="{{route('material_status',[$item->id, 0])}}" onclick="return confirmAndDisable(this);">
                                                <div class="lead_check">
                                                    <div class="status_btn">
                                                        <badge class='badge pric_span btn-success badge-success'>Active </badge>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{route('material_status',[$item->id, 1])}}" onclick="return confirmAndDisable(this);">
                                                <div class="lead_check">
                                                    <div class="status_btn">
                                                        <badge class='badge pric_span btn-warning badge-warning'>InActive</badge>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('Material'))
                                            <a href="{{ url('/material/material/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye clr-white" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Material'))
                                            <a data-edit-id="{{ $item->id }}" class="btn-edit-modal" xhref="{{ url('/material/material/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o clr-white" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Material'))
                                            <form method="POST"
                                                  action="{{ url('/material/material' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o clr-white" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $material->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addMaterial" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}</h5>
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

                    <form method="POST" action="{{ url('/material/material') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="material-form">
                        {{ csrf_field() }}

                        @include ('material.material.form')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editMaterial" class="modal fade" tabindex="-1" aria-hidden="true"></div>
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

    <script>
        $(document).on('click', '.btn-edit-modal', function (e) {
            var id = $(this).data('edit-id');
            $.ajax({
                url: "{{route('edit_material_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editMaterial').html(result);
                    $('#editMaterial').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>
@endpush
