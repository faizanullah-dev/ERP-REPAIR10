@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProgressBoard') }} {{ $progressboard->id }}</h3>
                    @can('view-'.str_slug('ProgressBoard'))
                        <a class="btn btn-success pull-right" href="{{ url('/progressBoard/progress-board') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $progressboard->id }}</td>
                            </tr>
                            <tr>
                                <th> Lead </th>
                                <td> {{ $progressboard->getLead->title??""}} </td>
                            </tr>
                            <tr>
                               <th> Category </th>
                                   @forelse ($progressboard->getprogressBoardCategory as $value)
                                        <td>  {{ $value->getCategory->name??"" }} </td>
                                   @empty
                                        <td>No Data Found</td>
                                   @endforelse
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

