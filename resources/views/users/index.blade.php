@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Users List</h3>
                  {{--<a  class="btn btn-success pull-right" href="{{url('user/create')}}"><i class="icon-plus"></i> Add user</a>--}}
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key=>$user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{($user->name=='User'?"Admin":$user->name??'Not Available')}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{($user->roles()->pluck('name')->implode(', ')=='user')?'Admin':$user->roles()->pluck('name')->implode(', ')??'Not Available'}}</td>
                                            <th>
                                                <a href="{{url('user/edit/'.$user->id)}}">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                    </button>
                                                </a> &nbsp;&nbsp;
                                                @if($user->roles()->pluck('name')->implode(', ')=='user')
                                                    <a href="#" style="cursor:not-allowed;">
                                                        <button class="btn btn-primary btn-sm" style="cursor:not-allowed;" disabled>
                                                            <i class="icon-trash" style="cursor:not-allowed;"></i> 
                                                        </button>
                                                    </a>
                                                @else
                                                    <form method="GET"
                                                          action="{{url('user/delete/'.$user->id)}}"
                                                          accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                        <button type="button" class="btn btn-sm"
                                                                title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'User') }}"
                                                                onclick="showDeleteConfirmation(this)">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>

                                                @endif
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.delete',function (e) {
                if(confirm('Are you sure want to delete?'))
                {
                }
                else
                {
                    return false;
                }
            });
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

        $(function() {
            $('#myTable').DataTable({
                "columns": [
                    null, null,null, {"orderable": false},null
                ]
            });

        });
    </script>

@endpush