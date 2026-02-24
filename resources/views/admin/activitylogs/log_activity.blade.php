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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Logs') }}</h3>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>User Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $key => $log)
                                 {{--@php--}}
                                    {{--@$url_parts = explode('/', $item->url);--}}
                                    {{--@$value_after_slash = $url_parts[5];--}}
                                    {{--@$url_parts = explode('/', $item->url);--}}
                                    {{--@$last_segment = end($url_parts);--}}
                                 {{--@endphp--}}
                                    {{--@if($value_after_slash == 'logActivity' || $value_after_slash == 'delete_logs' || $value_after_slash == 'delete_stream' || $last_segment == 'delete_stream' || is_numeric($last_segment)) @continue @endif--}}
                                    <tr>
                                        <td>{{$loop->iteration??$item->id}}</td>
                                        {{--<td>@if($item->user->name == 'User') Admin @else {{ $item->user->name??"" }} @endif visits  @if($last_segment == 'public') home page @else {{ $last_segment??"" }} @endif sections</td>--}}
                                        {{--<td>@if($item->user->name == 'User') Admin @else {{ $item->user->name??"" }} @endif</td>--}}
                                        <td>@if($log->log_name == 'User') Admin  @else {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $log->log_name) }} @endif {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $log->description) }}</td>
                                        <td>@if($log->log_name == 'User') Admin  @else {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $log->log_name) }} @endif </td>
                                        <td>{{--<a class="btn btn-primary btn-sm" href="{{ $item->url??"" }}">VISIT</a>--}} <a class="btn btn-primary btn-sm" href="{{route('delete_logs')}}/{{ $log->id??"" }}">DELETE</a></td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--<div class="pagination-wrapper"> {!! $logs->appends(['search' => Request::get('search')])->render() !!} </div>--}}
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
@endpush
