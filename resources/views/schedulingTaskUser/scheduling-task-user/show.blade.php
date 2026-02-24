@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SchedulingTaskUser') }} {{ $schedulingtaskuser->id }}</h3>
                    @can('view-'.str_slug('SchedulingTaskUser'))
                        <a class="btn btn-success pull-right" href="{{ url('/schedulingTaskUser/scheduling-task-user') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $schedulingtaskuser->id }}</td>
                            </tr>
                            <tr><th> Scheduling Task Id </th><td> {{ $schedulingtaskuser->scheduling_task_id }} </td></tr><tr><th> User Id </th><td> {{ $schedulingtaskuser->user_id }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

