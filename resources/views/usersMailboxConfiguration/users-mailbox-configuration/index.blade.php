@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UsersMailboxConfiguration') }}</h3>
                    @can('add-'.str_slug('UsersMailboxConfiguration'))
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Mail Host</th>
                                <th>Mail Port</th>
                                <th>Mail Encryption Type</th>
                                <th>Mail Username</th>
                                <th>Mail Protocol</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usersmailboxconfiguration as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>
                                        @if(auth()->user()->hasRole('user'))
                                            {{ @$item->user->first_name.' '.@$item->user->last_name }}
                                        @else
                                            {{ $item->user->name??"Not Available" }}
                                        @endif
                                    </td>
                                    <td>{{ $item->mail_host??'' }}</td>
                                    <td>{{ $item->mail_port??'' }}</td>
                                    <td>{{ $item->mail_encryption_type??'' }}</td>
                                    <td>{{ $item->mail_username??'' }}</td>
                                    <td>{{ $item->mail_protocol??'' }}</td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('UsersMailboxConfiguration'))
                                            <a class="" view-id="{{$item->id}}"
{{--                                            <a class="view_btn" href="{{ url('/usersMailboxConfiguration/users-mailbox-configuration/'. $item->id) }}"--}}
                                                title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UsersMailboxConfiguration') }}">
                                                <button class="btn green_btn btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan
{{--                                        @can('edit-'.str_slug('UsersMailboxConfiguration'))--}}
{{--                                            <a href="{{ url('/usersMailboxConfiguration/users-mailbox-configuration/' . $item->id . '/edit') }}"--}}
{{--                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UsersMailboxConfiguration') }}">--}}
{{--                                                <button class="btn btn-primary btn-sm">--}}
{{--                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}
                                        @can('delete-'.str_slug('UsersMailboxConfiguration'))
                                            <form method="POST"
                                                  action="{{ url('/usersMailboxConfiguration/users-mailbox-configuration' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UsersMailboxConfiguration') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $usersmailboxconfiguration->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="view_modal" class="modal fade dummymodal " role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="view_modal_content">


            </div>
        </div>
    </div>

@endsection

@push('js')
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
        $(document).on('click', '.view_btn', function () {
            var id = $(this).attr('view-id');
            $.ajax({
                url: "{{ url('/usersMailboxConfiguration/users-mailbox-configuration') }}/" + id,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $('#view_modal_content').html(data); // This will insert just the table
                    $('#view_modal').modal('show'); //modal show.
                }//end success.
            });//ends ajax.
        });//ends click.
    </script>

@endpush
