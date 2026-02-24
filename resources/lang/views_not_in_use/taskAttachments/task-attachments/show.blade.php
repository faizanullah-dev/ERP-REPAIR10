@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'TaskAttachment') }} {{ $taskattachment->id }}</h3>
                    @can('view-'.str_slug('TaskAttachment'))
                        <a class="btn btn-success pull-right" href="{{ url('/taskAttachments/task-attachments') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $taskattachment->id }}</td>
                            </tr>
                            <tr><th> Task Id </th><td> {{ $taskattachment->task_id }} </td></tr><tr><th> Name </th><td> {{ $taskattachment->name }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

