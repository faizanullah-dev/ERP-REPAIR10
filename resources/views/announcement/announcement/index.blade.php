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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}</h3>
                    @can('add-'.str_slug('Announcement'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/announcement/announcement/create') }}">--}}
                            {{--<i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}--}}
                        {{--</a>--}}
                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addAnnouncement" href="#">
                            <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Announcement</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcement as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{!!  substr($item->description,0, 100).'....' !!} </td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('Announcement'))
                                            <a href="javascript:void(0)"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}" class="view_announcement" data-id="{{ $item->id }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> 
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Announcement'))
                                            <a data-edit-id="{{ $item->id }}" class="btn-edit-modal" xhref="{{ url('/announcement/announcement/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Announcement'))
                                            <form method="POST"
                                                  action="{{ url('/announcement/announcement' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="button" class="btn delete_btn btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}"
                                                        onclick="showDeleteConfirmation(this)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--<div class="pagination-wrapper"> {!! $announcement->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--View Modal--}}
    <div id="viewModalDiv"></div>

    <div id="addAnnouncement" class="modal fade" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Announcement') }}</h5>
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

                    <form method="POST" action="{{ url('/announcement/announcement') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="announcement_form">
                        {{ csrf_field() }}

                        @include ('announcement.announcement.form')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editAnnouncement" class="modal fade" tabindex="-1" aria-hidden="true"></div>
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
        $(document).on('click', '.btn-edit-modal', function (e) {
            var id = $(this).data('edit-id');
            $.ajax({
                url: "{{route('edit_announcement_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editAnnouncement').html(result);
                    $('#editAnnouncement').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.view_announcement', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url: "{{url('view_announcement_modal')}}",
                type: 'get',
                data: {
                    'id':id,
                },
                success: function (result) {
                    $('#viewModalDiv').html(result);
                    $('#viewModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>
@endpush
