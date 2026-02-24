@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Team') }} {{ $team->id }}</h3>
                    @can('view-'.str_slug('Team'))
                        <a class="btn btn-success pull-right" href="{{ url('/team/team') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $team->id }}</td>
                            </tr>
                            <tr>
                                <th> Name </th>
                                <td> {{ $team->name }} </td>
                            </tr>
                            <tr>
                                <th> Team Member </th>

                                <td>
                                    @forelse($team->getUserTeam as $userteam)
                                        {{ $userteam->getUserTeamDetail->name??"" }}
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

