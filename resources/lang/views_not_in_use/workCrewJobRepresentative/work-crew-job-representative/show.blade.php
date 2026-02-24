@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'WorkCrewJobRepresentative') }} {{ $workcrewjobrepresentative->id }}</h3>
                    @can('view-'.str_slug('WorkCrewJobRepresentative'))
                        <a class="btn btn-success pull-right" href="{{ url('/workCrewJobRepresentative/work-crew-job-representative') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $workcrewjobrepresentative->id }}</td>
                            </tr>
                            <tr><th> Work Crew Id </th><td> {{ $workcrewjobrepresentative->work_crew_id }} </td></tr><tr><th> User Id </th><td> {{ $workcrewjobrepresentative->user_id }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

