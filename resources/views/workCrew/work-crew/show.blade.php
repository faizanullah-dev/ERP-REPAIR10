@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'WorkCrew') }} {{ $workcrew->id }}</h3>
                    @can('view-'.str_slug('WorkCrew'))
                        <a class="btn btn-success pull-right" href="{{ url('/workCrew/work-crew') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $workcrew->id }}</td>
                            </tr>
                            <tr>
                                <th> Lead </th>
                                <td> {{ $workcrew->getLead->title }} </td>
                            </tr>
                            <tr>
                                <th> Category </th>
                                <td> {{ $workcrew->getCategory->name }} </td>
                            </tr>
                            <tr>
                                <th> Job Representative </th>
                                <td>
                                    @forelse($workcrew->getWorkCrewJobRepresantative as $workrepresentative)
                                        {{ $workrepresentative->getCrewJobRepresentativeDetail->name??"" }}
                                    @empty
                                        <p>No Data Available</p>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th> Company Crew </th>
                                <td>
                                    @forelse($workcrew->getWorkCrewCompanyCrew as $workCrewCompanyCrew)
                                        {{ $workCrewCompanyCrew->getWorkCrewCompanyCrewDetail->name??"" }}
                                        @empty
                                            <p>No Data Available</p>
                                        @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th> Labour  </th>
                                <td>
                                    @forelse($workcrew->getWorkCrewLabour as $workCrewLabour)
                                        {{ $workCrewLabour->getWorkCrewLabourDetail->name??"" }}
                                        @empty
                                            <p>No Data Available</p>
                                        @endforelse
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

