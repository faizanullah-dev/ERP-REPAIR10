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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}</h3>
                    @can('add-'.str_slug('Team'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/team/team/create') }}">--}}
                            {{--<i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}--}}
                        {{--</a>--}}

                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addTeam" href="#">
                            <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->name??"Not Available" }}</td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('Team'))
                                            <a href="javascript:void(0)"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}" class="team_view" data-id="{{ $item->id }}">
                                                <button class="btn view_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Team'))
                                            <a data-edit-id="{{ $item->id }}" class="btn-edit-modal" xhref="{{ url('/team/team/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}">
                                                <button class="btn edit_btn btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Team'))
                                            <form method="POST"
                                                  action="{{ url('/team/team' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="button" class="btn delete_btn btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}"
                                                        onclick="showDeleteConfirmation(this)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
{{--                        <div class="pagination-wrapper"> {!! $team->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--View Modal--}}
    <div id="viewModalDiv"></div>

    <div id="addTeam" class="modal fade" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }}</h5>
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

                    <form method="POST" action="{{ url('/team/team') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

{{--                        @include ('team.team.form')--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">{{ 'Name' }}</label>
                                    {{--            <input class="form-control" placeholder="Enter team name" name="name" type="text" id="name" value="{{ $team->getUserTeam->pluck('name')??''}}"  required>--}}
                                    <input class="form-control" placeholder="Enter team name" name="name" type="text" id="name" value=""  required>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_user_id" class="control-label">{{ 'Users' }}</label>
                                    <select class="form-control  borderRadius custom_modal_select2" multiple name="user_team_id[]" id="user_team_id" required>
                                        @foreach ($roles as $role)
                                            @if ($role->name !== 'admin' && $role->name !== 'user')
                                                <optgroup label="{{ $role->name }}">
                                                    @foreach ($role->users as $user)
                                                        <option value="{{ $user->id }}" >
                                                            {{--                                <option value="{{ $user->id }}">--}}
                                                            {{ $user->name ?? "" }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editTeam" class="modal fade" tabindex="-1" aria-hidden="true"></div>
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

        $(document).ready(function () {
            $('#addTeam').find('.select2').select2();

        });

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
                url: "{{route('edit_team_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editTeam').html(result);
                    $('#editTeam').modal('show');
                    $('#editTeam').find('.select2').select2();
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.team_view', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url: "{{url('view_team_modal')}}",
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
